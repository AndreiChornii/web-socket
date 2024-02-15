<?php

use OpenSwoole\WebSocket\{Server, Frame};
use OpenSwoole\Constant;
use OpenSwoole\Table;
use OpenSwoole\Http\Request;

$server = new Server("127.0.0.1", 9501, Server::SIMPLE_MODE, Constant::SOCK_TCP);

$fds = new Table(1024);
$fds->column('fd', Table::TYPE_INT, 4);
$fds->column('name', Table::TYPE_STRING, 16);
$fds->create();

$server->on("Start", function (Server $server) {
    echo "Swoole WebSocket Server is started at " . $server->host . ":" . $server->port . "\n";
});

$server->on('Open', function (Server $server, Request $request) use ($fds) {
    $fd = $request->fd;
    $clientName = sprintf("Client-%'.06d\n", $request->fd);
    $fds->set($request->fd, ['fd' => $fd, 'name' => sprintf(($clientName))]);
    echo "Connection <{$fd}>opend by {$clientName}. Total connections: " . $fds->count() . "\n";
    foreach ($fds as $key => $value) {
        if ($key == $fd) {
            $server->push($key, "Welcome {$clientName}, there are " . $fds->count() . " connections ");
        } else {
            $server->push($key, "A client ({$clientName}) is joining to the party");
        }
    }
});

$server->on('Message', function (Server $server, Frame $frame) use ($fds) {
    $sender = $fds->get(strval($frame->fd), "name");
    echo "Received from " . $sender . ", message: {$frame->data}" . PHP_EOL;
    foreach ($fds as $key => $value) {
        if ($key == $frame->fd) {
            $server->push($key, "Message sent");
        } else {
            $server->push($key, "FROM: {$sender} - MESSAGE: " . $frame->data);
        }
    }
});

$server->on('Close', function (Server $server, int $fd) use ($fds) {
    $fds->del($fd);
    echo "Connection close: {$fd}, total connections: " . $fds->count() . "\n";
});

$server->on("Disconnect", function (Server $server, int $fd) use ($fds) {
    $fds->del($fd);
    echo "Disconnect: {$fd}, total connections: " . $fds->count() . "\n";
});

$server->start();

<?php
namespace App\VPS;

interface VPSInterface
{
    public function __construct($token);

    public function create($type, $accessIP);
}
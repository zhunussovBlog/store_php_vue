<?php
include_once '../../settings/header_settings.php';
include_once '../../settings/db_settings.php';
include_once '../../models/Type.php';

$data = json_decode(file_get_contents('php://input'), true);

<?php

session_start();
session_destroy();

require "../functions.php";

header("location: ../");

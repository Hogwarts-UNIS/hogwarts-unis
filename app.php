<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Model\ChapeuSeletor;

$chapeu = new ChapeuSeletor();
$chapeu->perguntarSelecionarCasa();
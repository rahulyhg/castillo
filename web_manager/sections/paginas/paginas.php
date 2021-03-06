<?php
date_default_timezone_set('America/Lima');
include '../../connection.php';

$act = $_GET['action'];

if($act == 'getPaginas') {
    header('Content-Type: application/json');
    $db->orderBy('ID');
    echo json_encode($db->get('paginas'));
}

if($act == 'getPagina') {
    $id = $_GET['pID'];
    header('Content-Type: application/json');
    $db->where('ID', $id);
    echo json_encode($db->getOne('paginas'));
}

if($act == 'actualizarEstado') {
    $estado = $_GET['est'];
    $id = $_GET['pID'];
    $data = Array(
        'ACTIVO' => $estado
    );
    $db->where ('ID', $id);
    if ($db->update ('paginas', $data))
        echo '1';
    else {
        echo $db->getLastError();
    }
}

if($act == 'grabar') {
    $titulo = $_POST['p_titulo'];
    $contenido = $_POST['p_contenido'];
    $enlace = $_POST['p_enlace'];
    $estado = $_POST['p_estado'];

    $data = Array(
        'TITULO' => $titulo,
        'CONTENIDO' => $contenido,
        'ACTIVO' => $estado,
        'LINK' => $enlace
    );

    $id = $db->insert ('paginas', $data);

    if($id) {
        echo '1';
    } else {
        echo $db->getLastError();
    }
}

if($act == 'actualizar') {
    $id = $_GET['pID'];
    $titulo = $_POST['p_titulo'];
    $contenido = $_POST['p_contenido'];
    $enlace = $_POST['p_enlace'];
    $estado = $_POST['p_estado'];

    $data = Array(
        'TITULO' => $titulo,
        'CONTENIDO' => $contenido,
        'ACTIVO' => $estado,
        'LINK' => $enlace
    );

    $db->where ('ID', $id);
    if($db->update('paginas', $data)) {
        echo '1';
    } else {
        echo $db->getLastError();
    }
}

if($act == 'eliminar') {
    $id = $_GET['pID'];
    $db->where ('ID', $id);
    if($db->delete('paginas', $data)) {
        echo '1';
    } else {
        echo $db->getLastError();
    }
}
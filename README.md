# ISW Grupo 5

## “Recepción de equipos en contrato nuevo”

El sistema permite al Jefe de Servicios y encargados facilitar la
recepción de equipos de contratos nuevos generando una reducción de costos y tiempo

## Software stack

El proyecto "Perfiles de equipamiento computacional de los contratos" es una aplicación web que corre sobre el siguiente software:

- Ubuntu GNU/Linux 18 Buster
- Apache 2
- PHP 7.3
- Base de Datos MySQL 5.6

## Configuraciones de Ejecución para Entorno de Desarrollo/Producción

1) Abrir una terminal linux/macOS o putty desde windows (ingresando directamente la ip y puerto. Luego le pedira ingresar el usuario y contraseña)
2) (Solo linux/maxOS)Ingresar al sevidor con el comando {ssh (usuario)@(ip servidor) -p (puerto ssh)}

        ssh (usuario)@(ip del servidor) -p (puerto ssh)

3) Debe ingresar correctamente la contraseña del usuario
4) Una vez dentro del servidor entrar en usuario root con el comando {su -} e ingresando la contraseña de dicho usuario

        - su -

5) Dentro de usuario root debera ejecutar multiples comandos para instalar todas las dependencias necesarios para ejecutar el software (Para evitar problemas, ejecute los comados 1 a 1 y en completo orden)

        - apt update
        - apt upgrade
        - apt-get install nano
        - apt update
        - apt install xclip
        - apt update
        - apt install apache2
        - apt update
        - apt upgrade
        - apt install software-properties-common
        - add-apt-repository ppa:ondrej/php
        - apt update
        - apt install php7.3
        - apt install php7.3-common
        - apt install php7.3-mysql
        - apt install php7.3-curl
        - apt update
        - apt install git

6) Una vez instalado todo correctamente utilizar el comando service apache2 restart

        - service apache2 restart

7) Ahora debe asignar los permisos necesarios para acceder y mantener segura la carpeta de acceso a la web

        - chmod 755 -R /var/www/html                                                        *comando para quitar permisos a otros usuario)
        - chown (nombre del usuario con el que entro al sv, no el root) /var/www/html       *comando para asignar el webmater de esa dirección

8) debe salir del usuario root con el comando {exit}

        - exit

9) Una vez todo configurado debe ir al repositorio del proyecto desde un navegador (git), selecionar su usuario (esquina superior derecha), settings, ssh keys (menu izquierda). Vera un text area donde debe pegar la clave que generara ahora.

10) Dentro de la terminar ingresar el comando {ssh-keygen -t ed25519 -C "email del usuario git} para generar clave. Una vez ingresado el comando debe presionar ENTER cada vez que pregunte algo.

        - ssh-keygen -t ed25519 -C "email del usuario git"

11) Ejecutar el siguiente comando para copiar la clave desde el servidor

        - xclip -sel clip < ~/.ssh/id_ed25519.pub

12) Debe volver al navegador y pegar dentro del text ahora la clave copiada desde el servidor. Luego presionar add key para vincular git con el servidor.      

13) debe ir a la raiz del servidor con el comando {cd ..} (debe ejecutar dicho comando hasta estar en el directorio "/", para saber el directorio en el que se encuentra ejecute el comando {pwd}) PD: El directorio "/" es el ultimo del servidor, no puede ir mas atras.

        - cd ..                *cuantas veces sea necesaria
        - pwd                  *para saber el directorio en el que se encuentra

14) Dentro del directorio "/" ejecutar los siguientes comandos

        - cd /var/www/html

15) Volver al navegador y abrir el repositorio posicionado en la rama "master", selecionar el boton clone y copiar el enlace ssh

16) Dentro del directorio "/var/www/html" ejecutar el comando {git clone (enlace ssh del repositorio)}.

        - git clone (enlace ssh del repositorio)

17) Ahora debera cambiar las credenciales para establecer conexion con la Base de datos con el comando {nano isw-grupo-5/isw/clases/conexion.php}. Se abrira una ventana de texto donde debera cambiar las credenciales (CRTL + O para guardar y CTRL + X para salir).

        - nano isw-grupo-5/isw/clases/conexion.php
        - $conexion = mysqli_connect("host","user","password","namebd");             *Reemplazar el host con la URL del servidor, user con el usuario del servidor, password con           
                                                                                    la contraseña del usuario y "namebd" con el nombre de la base de datos.
                                                                                    Todos estos datos dentro de comillas propias.
        - CRTL + O
        - CTRL + X                                                                             

18) En un navegador debe ir a la url {ip servidor:puerto apache/isw-grupo-5/isw}

        - ip servidor:puerto apache/isw-grupo-5/isw


PD: En caso de presentar error vuelva a entrar en usuario root {su -} y ejecute el comando {service apache2 restart}

        - su -
        - service apache2 restart
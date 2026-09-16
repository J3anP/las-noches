# 🌙 LAS NOCHES — CTF de cierre (Sesión 6)

Servidor vulnerable para el CTF final del curso. Corre 100% local en la máquina de cada alumno vía Docker.

> 🟢 Nivel: básico. Ningún paso requiere escribir código ni usar sintaxis compleja de shell.

## 🎯 Los 4 retos

| # | Reto | Categoría OWASP | Dónde | Dificultad |
|---|---|---|---|---|
| 1 | SQL Injection — bypass de login | A03 Injection | index.php | Fácil |
| 2 | XSS Almacenado — panel de notas | A03 Injection | panel.php | Fácil |
| 3 | RCE — Command Injection | A03 Injection | ping.php | Fácil |
| 4 | Escalada de privilegios — cronjob + SUID | — | Post-explotación | Fácil |

El camino oficial del Reto 3 es Command Injection (ping.php). El formulario de subida (upload.php) es un bonus opcional.

Documenta cada flag con captura de pantalla + el payload/comando exacto usado — sin evidencia del proceso, la flag no cuenta como resuelta.

Pistas progresivas en HINTS.md si te trabas.

## Requisitos previos en Kali

```bash
sudo apt update
sudo apt install -y docker.io docker-compose-v2 dos2unix
sudo systemctl enable --now docker
sudo usermod -aG docker $USER
newgrp docker
```

## Despliegue

```bash
git clone <url-del-repo>
cd las-noches
docker compose up -d --build
docker ps
```

Accede en: http://localhost:8090

## Reset completo

```bash
docker compose down -v
docker compose up -d --build
```

## Problemas comunes

| Problema | Solución |
|---|---|
| permission denied al correr docker | sudo usermod -aG docker $USER && newgrp docker |
| Cannot connect to the Docker daemon | sudo systemctl start docker |
| port is already allocated | Cambia "8090:80" en docker-compose.yml |
| La página no carga y tienes Burp Suite abierto | Desactiva el proxy del navegador o el Intercept de Burp |
| El cronjob no hace nada | Espera hasta 60 segundos, corre cada minuto |
| Errores raros de sintaxis en cron | dos2unix cron/cleanup-cron |

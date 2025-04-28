<!-- navbar.php -->
<style>
    nav {
        background-color: rgb(250, 113, 49);
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 40px;
        position: fixed;
        top: 0;
        width: 100%;
        box-sizing: border-box;
        z-index: 1000;
    }

    .nav-left {
        font-size: 1.5em;
        font-weight: bold;
        display: flex;
        align-items: center;
    }

    .nav-left img {
        height: 60px;
        margin-right: 10px;
    }

    .nav-links {
        display: flex;
        gap: 0;
    }

    .nav-links a {
        background-color: transparent;
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
        font-size: 1.1em;
        transition: background-color 0.3s, transform 0.2s ease;
        border: 2px solid transparent;
        display: flex;
        align-items: center;
        margin: 5px 25px 5px 0;
    }

    .nav-links a:hover {
        background-color: rgba(255, 255, 255, 0.2);
        color: #6f42c1; /* Cambiado a morado */
    }
</style>

<nav>
    <div class="nav-left">
        <img src="/TextilExport/Public/IMG/logo.png" alt="Logo TextilExport">
        TextilExport
    </div>
    <div class="nav-links">
        <a href="/TextilExport/Auth/login">Empleado</a>
        <a href="/TextilExport/">Página Principal</a>
    </div>
</nav>

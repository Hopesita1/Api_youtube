<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #ffffff;
            --surface: #f2f2f2;
            --hover: #e5e5e5;
            --text: #0f0f0f;
            --muted: #606060;
            --border: #e5e5e5;
            --red: #ff0000;
            --header-h: 56px;
        }
        html { font-size: 14px; }
        body { font-family: 'Roboto', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; }

        /* ── HEADER ── */
        header {
            position: fixed; top: 0; left: 0; right: 0; z-index: 300;
            height: var(--header-h);
            background: var(--bg);
            display: flex; align-items: center;
            padding: 0 16px;
            gap: 8px;
            border-bottom: 1px solid var(--border);
        }
        .hd-left { display: flex; align-items: center; gap: 16px; min-width: 220px; }
        .menu-btn {
            background: none; border: none; cursor: pointer; padding: 8px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center; color: var(--text);
            transition: background 0.15s;
        }
        .menu-btn:hover { background: var(--surface); }
        .yt-wordmark { display: flex; align-items: center; gap: 4px; text-decoration: none; }
        .yt-icon { width: 28px; height: 20px; }
        .yt-text { font-size: 20px; font-weight: 700; color: var(--text); letter-spacing: -0.5px; }

        .hd-center { flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .search-form { display: flex; max-width: 540px; width: 100%; }
        #q {
            flex: 1; height: 40px;
            border: 1px solid #ccc; border-right: none;
            border-radius: 40px 0 0 40px;
            padding: 0 16px; font-size: 16px; font-family: 'Roboto', sans-serif;
            color: var(--text); background: #fff;
            outline: none; transition: border-color 0.15s, box-shadow 0.15s;
        }
        #q:focus { border-color: #1c62b9; box-shadow: inset 0 1px 2px rgba(28,98,185,0.3); }
        #q::placeholder { color: #aaa; }
        #btn-buscar {
            height: 40px; width: 64px;
            background: var(--surface); border: 1px solid #ccc; border-radius: 0 40px 40px 0;
            color: var(--text); font-size: 18px; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: background 0.15s;
        }
        #btn-buscar:hover { background: #e5e5e5; }
        .mic-btn {
            width: 40px; height: 40px; border-radius: 50%; border: none;
            background: var(--surface); cursor: pointer; color: var(--text);
            display: flex; align-items: center; justify-content: center;
            transition: background 0.15s; flex-shrink: 0;
        }
        .mic-btn:hover { background: var(--hover); }

        .hd-right { display: flex; align-items: center; gap: 8px; min-width: 220px; justify-content: flex-end; }
        .hd-btn {
            height: 36px; border: 1px solid #ccc; border-radius: 20px;
            background: none; cursor: pointer; font-family: 'Roboto', sans-serif;
            font-size: 14px; font-weight: 500; color: #065fd4;
            display: flex; align-items: center; gap: 6px; padding: 0 16px;
            transition: background 0.15s;
        }
        .hd-btn:hover { background: #def1ff; border-color: #065fd4; }
        .icon-btn {
            width: 40px; height: 40px; border-radius: 50%; border: none;
            background: none; cursor: pointer; color: var(--text);
            display: flex; align-items: center; justify-content: center;
            transition: background 0.15s; position: relative;
        }
        .icon-btn:hover { background: var(--hover); }
        .notif-badge {
            position: absolute; top: 4px; right: 4px;
            background: var(--red); color: #fff; border-radius: 10px;
            font-size: 10px; font-weight: 700; padding: 1px 4px; min-width: 16px; text-align: center;
        }
        .avatar-btn {
            width: 32px; height: 32px; border-radius: 50%; border: none;
            background: #065fd4; cursor: pointer; color: #fff;
            font-size: 14px; font-weight: 700; flex-shrink: 0;
        }

        /* ── LAYOUT ── */
        .layout { display: flex; margin-top: var(--header-h); }

        /* ── SIDEBAR ── */
        aside {
            width: 240px; min-width: 240px;
            position: fixed; top: var(--header-h); left: 0; bottom: 0;
            overflow-y: auto; overflow-x: hidden;
            padding: 12px 0;
            background: var(--bg);
            scrollbar-width: none;
        }
        aside::-webkit-scrollbar { display: none; }
        .side-item {
            display: flex; align-items: center; gap: 24px;
            padding: 0 12px; height: 40px; border-radius: 10px; margin: 0 12px;
            cursor: pointer; font-size: 14px; font-weight: 400;
            transition: background 0.1s; text-decoration: none; color: var(--text);
        }
        .side-item:hover { background: var(--hover); }
        .side-item.active { background: var(--surface); font-weight: 500; }
        .side-item svg { flex-shrink: 0; }
        .side-divider { height: 1px; background: var(--border); margin: 8px 0; }
        .side-section { padding: 12px 20px 4px; font-size: 15px; font-weight: 500; }

        /* ── MAIN ── */
        main { margin-left: 240px; flex: 1; min-width: 0; }

        /* ── CHIPS ── */
        .chips-wrap {
            position: sticky; top: var(--header-h); z-index: 200;
            background: var(--bg); padding: 12px 24px;
            display: flex; gap: 8px; overflow-x: auto;
            scrollbar-width: none; border-bottom: 1px solid var(--border);
        }
        .chips-wrap::-webkit-scrollbar { display: none; }
        .chip {
            background: var(--surface); color: var(--text);
            border: none; border-radius: 8px;
            padding: 6px 12px; font-size: 14px; font-family: 'Roboto', sans-serif;
            white-space: nowrap; cursor: pointer; transition: background 0.15s;
            flex-shrink: 0;
        }
        .chip:hover { background: var(--hover); }
        .chip.active { background: var(--text); color: var(--bg); }

        /* ── GRID ── */
        .grid-wrap { padding: 24px; }
        .search-label { font-size: 16px; color: var(--muted); margin-bottom: 16px; display: none; }
        .search-label.visible { display: block; }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 16px 12px;
        }

        /* ── CARD ── */
        .card { cursor: pointer; animation: fadeIn 0.3s ease both; }
        .thumb-wrap {
            position: relative; width: 100%; aspect-ratio: 16/9;
            border-radius: 12px; overflow: hidden; background: #e5e5e5;
        }
        .thumb-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.2s; display: block; }
        .card:hover .thumb-wrap img { transform: scale(1.03); }
        .dur-badge {
            position: absolute; bottom: 4px; right: 6px;
            background: rgba(0,0,0,0.8); color: #fff;
            font-size: 12px; font-weight: 500; padding: 2px 6px; border-radius: 4px;
        }
        .live-badge {
            position: absolute; bottom: 4px; right: 6px;
            background: var(--red); color: #fff;
            font-size: 11px; font-weight: 700; padding: 2px 6px; border-radius: 4px;
        }
        .card-info { display: flex; gap: 12px; padding: 12px 0 4px; }
        .avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: #065fd4; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; font-weight: 700; color: #fff;
        }
        .card-meta { flex: 1; min-width: 0; }
        .card-title {
            font-size: 14px; font-weight: 500; line-height: 1.4; color: var(--text);
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
            margin-bottom: 4px;
        }
        .card-channel { font-size: 13px; color: var(--muted); margin-bottom: 2px; }
        .card-channel:hover { color: var(--text); }
        .card-stats { font-size: 13px; color: var(--muted); }
        .more-btn {
            width: 36px; height: 36px; border-radius: 50%; border: none;
            background: none; cursor: pointer; color: var(--muted);
            display: flex; align-items: center; justify-content: center;
            opacity: 0; transition: opacity 0.15s, background 0.15s;
            flex-shrink: 0; align-self: flex-start; margin-top: -4px;
        }
        .card:hover .more-btn { opacity: 1; }
        .more-btn:hover { background: var(--hover); color: var(--text); }

        /* ── MODAL ── */
        .modal-bg {
            position: fixed; inset: 0; background: rgba(0,0,0,0.7);
            z-index: 500; display: flex; align-items: center; justify-content: center;
            padding: 20px; opacity: 0; pointer-events: none; transition: opacity 0.2s;
        }
        .modal-bg.open { opacity: 1; pointer-events: all; }
        .modal-box {
            background: #fff; border-radius: 12px; overflow: hidden; width: 100%; max-width: 920px;
            transform: translateY(16px); transition: transform 0.25s; box-shadow: 0 8px 48px rgba(0,0,0,0.3);
        }
        .modal-bg.open .modal-box { transform: translateY(0); }
        .modal-top {
            display: flex; align-items: center; justify-content: space-between;
            padding: 10px 16px; border-bottom: 1px solid var(--border); gap: 12px;
        }
        .modal-title {
            font-size: 15px; font-weight: 500; flex: 1;
            display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden;
        }
        .modal-close {
            background: none; border: none; color: var(--muted); font-size: 20px;
            cursor: pointer; padding: 4px 8px; border-radius: 50%; transition: background 0.15s;
        }
        .modal-close:hover { background: var(--hover); color: var(--text); }
        .iframe-wrap { aspect-ratio: 16/9; background: #000; }
        .iframe-wrap iframe { width: 100%; height: 100%; border: none; display: block; }
        .modal-bottom {
            padding: 12px 16px; display: flex; align-items: center; justify-content: space-between; gap: 12px;
        }
        .modal-channel { font-size: 13px; color: var(--muted); }
        .btn-watch {
            display: inline-flex; align-items: center; gap: 6px;
            background: var(--red); color: #fff; text-decoration: none;
            border-radius: 20px; padding: 8px 16px; font-size: 14px; font-weight: 500;
            transition: background 0.15s;
        }
        .btn-watch:hover { background: #cc0000; }

        /* LOADER */
        .loader-wrap { grid-column: 1/-1; display: flex; justify-content: center; padding: 80px; }
        .spinner { width: 40px; height: 40px; border: 3px solid var(--border); border-top-color: var(--red); border-radius: 50%; animation: spin 0.7s linear infinite; }

        @keyframes spin { to { transform: rotate(360deg); } }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        @media (max-width: 900px) {
            aside { display: none; }
            main { margin-left: 0; }
            .hd-left { min-width: auto; }
            .hd-right { min-width: auto; }
        }
    </style>
</head>
<body>

<!-- HEADER -->
<header>
    <div class="hd-left">
        <button class="menu-btn">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>
        </button>
        <a class="yt-wordmark" href="#">
            <svg class="yt-icon" viewBox="0 0 28 20" fill="none">
                <rect width="28" height="20" rx="6" fill="#FF0000"/>
                <polygon points="11,6 20,10 11,14" fill="white"/>
            </svg>
            <span class="yt-text">YouTube</span>
        </a>
    </div>

    <div class="hd-center">
        <div class="search-form">
            <input type="text" id="q" placeholder="Buscar" onkeydown="if(event.key==='Enter')buscar()">
            <button id="btn-buscar" onclick="buscar()">
                <svg height="20" viewBox="0 0 24 24" width="20" fill="currentColor"><path d="M20.87 20.17l-5.59-5.59C16.35 13.35 17 11.75 17 10c0-3.87-3.13-7-7-7s-7 3.13-7 7 3.13 7 7 7c1.75 0 3.35-.65 4.58-1.71l5.59 5.59.7-.71zM10 16c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6z"/></svg>
            </button>
        </div>
        <button class="mic-btn">
            <svg height="20" viewBox="0 0 24 24" width="20" fill="currentColor"><path d="M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3zm-1-9c0-.55.45-1 1-1s1 .45 1 1v6c0 .55-.45 1-1 1s-1-.45-1-1V5zm6 6c0 2.76-2.24 5-5 5s-5-2.24-5-5H5c0 3.53 2.61 6.43 6 6.92V21h2v-3.08c3.39-.49 6-3.39 6-6.92h-2z"/></svg>
        </button>
    </div>

    <div class="hd-right">
        <button class="hd-btn">
            <svg height="16" viewBox="0 0 24 24" width="16" fill="#065fd4"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
            Crear
        </button>
        <button class="icon-btn">
            <svg height="24" viewBox="0 0 24 24" width="24" fill="currentColor"><path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/></svg>
            <span class="notif-badge">9+</span>
        </button>
        <button class="avatar-btn">U</button>
    </div>
</header>

<!-- LAYOUT -->
<div class="layout">

    <!-- SIDEBAR -->
    <aside>
        <a class="side-item active" href="#">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
            Inicio
        </a>
        <a class="side-item" href="#">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4zM14 13h-3v3H9v-3H6v-2h3V8h2v3h3v2z"/></svg>
            Shorts
        </a>
        <a class="side-item" href="#">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-8 12.5v-9l6 4.5-6 4.5z"/></svg>
            Suscripciones
        </a>
        <div class="side-divider"></div>
        <a class="side-item" href="#">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
            Tú
        </a>
        <div class="side-divider"></div>
        <div class="side-section">Explorar</div>
        <a class="side-item" href="#" onclick="filtrarChip('musica')">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
            Música
        </a>
        <a class="side-item" href="#" onclick="filtrarChip('gaming')">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M15 7.5V2H9v5.5l3 3 3-3zM7.5 9H2v6h5.5l3-3-3-3zM9 16.5V22h6v-5.5l-3-3-3 3zM16.5 9l-3 3 3 3H22V9h-5.5z"/></svg>
            Videojuegos
        </a>
        <a class="side-item" href="#" onclick="filtrarChip('tecnologia')">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V6h16v12z"/></svg>
            Tecnología
        </a>
        <div class="side-divider"></div>
        <a class="side-item" href="#">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
            Acerca de
        </a>
    </aside>

    <!-- MAIN -->
    <main>
        <!-- CHIPS -->
        <div class="chips-wrap" id="chips">
            <button class="chip active" onclick="filtrar('todos',this)">Todo</button>
            <button class="chip" onclick="filtrar('lofi',this)">Música</button>
            <button class="chip" onclick="filtrar('php',this)">Técnicas de estudio</button>
            <button class="chip" onclick="filtrar('cocina',this)">Cocina</button>
            <button class="chip" onclick="filtrar('naturaleza',this)">Naturaleza</button>
            <button class="chip" onclick="filtrar('tecnologia',this)">Tecnología</button>
            <button class="chip" onclick="filtrar('gaming',this)">Videojuegos</button>
            <button class="chip" onclick="filtrar('musica',this)">Entretenimiento</button>
            <button class="chip" onclick="filtrar('noticias',this)">Noticias</button>
        </div>

        <!-- GRID -->
        <div class="grid-wrap">
            <div class="search-label" id="search-label"></div>
            <div class="grid" id="grid">
                <div class="loader-wrap"><div class="spinner"></div></div>
            </div>
        </div>
    </main>
</div>

<!-- MODAL -->
<div class="modal-bg" id="modal-bg">
    <div class="modal-box">
        <div class="modal-top">
            <div class="modal-title" id="modal-title"></div>
            <button class="modal-close" id="btn-cerrar">✕</button>
        </div>
        <div class="iframe-wrap">
            <iframe id="yt-frame" allowfullscreen allow="autoplay; encrypted-media; picture-in-picture"></iframe>
        </div>
        <div class="modal-bottom">
            <div class="modal-channel" id="modal-channel"></div>
            <a id="modal-link" href="#" target="_blank" class="btn-watch">
                <svg height="16" viewBox="0 0 24 24" width="16" fill="white"><path d="M8 5v14l11-7z"/></svg>
                Ver en YouTube
            </a>
        </div>
    </div>
</div>

<script>
const DB = {
    lofi: [
        { id:'jfKfPfyJRdk', title:'lofi hip hop radio 📚 - beats to relax/study to', canal:'Lofi Girl', dur:'LIVE', vistas:'25M visualizaciones', hace:'hace 2 años' },
        { id:'5qap5aO4i9A', title:'lofi hip hop radio 💤 - beats to sleep/chill to', canal:'Lofi Girl', dur:'LIVE', vistas:'18M visualizaciones', hace:'hace 1 año' },
        { id:'DWcJFNfaw9c', title:'1A4 Studio - Lofi Hip Hop Mix [Chill Beats]', canal:'Lofi Hip Hop Music', dur:'1:00:00', vistas:'5.2M visualizaciones', hace:'hace 8 meses' },
        { id:'Na0w3Mz46GA', title:'Cozy Coffee Shop ☕ Lofi Hip Hop Mix', canal:'ChilledCow', dur:'2:00:00', vistas:'12M visualizaciones', hace:'hace 1 año' },
    ],
    php: [
        { id:'OK_JCtrrv-c', title:'PHP For Beginners | 3+ Hour Crash Course', canal:'Traversy Media', dur:'3:19:18', vistas:'2.1M visualizaciones', hace:'hace 2 años' },
        { id:'2eebptXfEvw', title:'PHP Tutorial for Beginners - Full Course', canal:'Bro Code', dur:'4:30:00', vistas:'1.8M visualizaciones', hace:'hace 1 año' },
        { id:'BUCiSSyIGGU', title:'PHP MySQL CRUD Application Tutorial', canal:'Traversy Media', dur:'1:45:00', vistas:'980K visualizaciones', hace:'hace 3 años' },
        { id:'pWG7ajC_OVo', title:'Learn PHP The Right Way - Full PHP Tutorial', canal:'Program With Gio', dur:'8:00:00', vistas:'620K visualizaciones', hace:'hace 10 meses' },
    ],
    cocina: [
        { id:'VVnZd8A84z4', title:'Tacos al Pastor - Receta Auténtica Mexicana', canal:'Cocina con Leo', dur:'15:30', vistas:'3.4M visualizaciones', hace:'hace 2 años' },
        { id:'ELzWHjAB9aE', title:'Enchiladas Verdes Caseras - Receta Fácil', canal:'México en la Cocina', dur:'20:00', vistas:'1.2M visualizaciones', hace:'hace 1 año' },
        { id:'f3bMPDMSJdk', title:'Chiles Rellenos - La Receta Perfecta', canal:'Cocina Mexicana', dur:'25:00', vistas:'890K visualizaciones', hace:'hace 6 meses' },
        { id:'sWiSkFekOOc', title:'Pozole Rojo - Receta Tradicional', canal:'El Guzii', dur:'30:00', vistas:'2.1M visualizaciones', hace:'hace 3 años' },
    ],
    naturaleza: [
        { id:'eKFTSSKCzWA', title:'8 Hours of Amazing Nature Sounds - Forest Birds & River', canal:'Nature Sounds', dur:'8:00:00', vistas:'45M visualizaciones', hace:'hace 4 años' },
        { id:'BHACKCNDMW8', title:'Beautiful Relaxing Music - Stunning Nature Landscapes 4K', canal:'Soothing Relaxation', dur:'3:00:00', vistas:'28M visualizaciones', hace:'hace 2 años' },
        { id:'6p_yUjSBJ7c', title:'Relaxing Rain Sounds for Sleep & Study', canal:'Rain Sounds', dur:'10:00:00', vistas:'62M visualizaciones', hace:'hace 5 años' },
        { id:'WHPEKLQID4U', title:'Ocean Waves Sounds for Deep Sleep', canal:'Ocean Sounds', dur:'8:00:00', vistas:'33M visualizaciones', hace:'hace 3 años' },
    ],
    tecnologia: [
        { id:'rfscVS0vtbw', title:'CS50 2024 - Lecture 0 - Scratch', canal:'CS50', dur:'2:00:00', vistas:'4.5M visualizaciones', hace:'hace 1 año' },
        { id:'zOjov-2OZ0E', title:'The Entire History of the Internet', canal:'Fireship', dur:'12:00', vistas:'8.2M visualizaciones', hace:'hace 2 años' },
        { id:'kqtD5dpn9C8', title:'JavaScript Full Course for Beginners', canal:'Bro Code', dur:'8:00:00', vistas:'3.1M visualizaciones', hace:'hace 1 año' },
        { id:'DCbGM4mqEVw', title:'Artificial Intelligence Full Course 2024', canal:'Simplilearn', dur:'9:00:00', vistas:'1.8M visualizaciones', hace:'hace 8 meses' },
    ],
    gaming: [
        { id:'dQw4w9WgXcQ', title:'Top 10 Best Games of 2024 - GOTY Contenders', canal:'IGN', dur:'15:00', vistas:'5.2M visualizaciones', hace:'hace 1 año' },
        { id:'M7lc1UVf-VE', title:'How to Get Better at Any Video Game', canal:'Game Theory', dur:'20:00', vistas:'7.8M visualizaciones', hace:'hace 2 años' },
        { id:'sTSA_sWGM44', title:'The History of Gaming - Full Documentary', canal:'Ahoy', dur:'45:00', vistas:'3.4M visualizaciones', hace:'hace 3 años' },
        { id:'9bZkp7q19f0', title:'Minecraft - Building the Ultimate Survival Base', canal:'Dream', dur:'25:00', vistas:'12M visualizaciones', hace:'hace 1 año' },
    ],
    musica: [
        { id:'JGwWNGJdvx8', title:'Ed Sheeran - Shape of You (Official Music Video)', canal:'Ed Sheeran', dur:'4:24', vistas:'6.1B visualizaciones', hace:'hace 7 años' },
        { id:'kXYiU_JCYtU', title:'Linkin Park - Numb (Official Video)', canal:'Linkin Park', dur:'3:08', vistas:'1.8B visualizaciones', hace:'hace 15 años' },
        { id:'hT_nvWreIhg', title:'OneRepublic - Counting Stars (Official)', canal:'OneRepublic', dur:'4:17', vistas:'3.2B visualizaciones', hace:'hace 10 años' },
        { id:'CevxZvSJLk8', title:'Katy Perry - Roar (Official Music Video)', canal:'Katy Perry', dur:'4:33', vistas:'3.8B visualizaciones', hace:'hace 10 años' },
    ],
    noticias: [
        { id:'rfscVS0vtbw', title:'Breaking News: Technology Revolution 2024', canal:'CNN', dur:'10:00', vistas:'2.1M visualizaciones', hace:'hace 1 semana' },
        { id:'zOjov-2OZ0E', title:'World News Today - Top Stories', canal:'BBC News', dur:'25:00', vistas:'980K visualizaciones', hace:'hace 2 días' },
        { id:'kqtD5dpn9C8', title:'Tech News Weekly - AI, Gadgets & More', canal:'TechCrunch', dur:'30:00', vistas:'450K visualizaciones', hace:'hace 3 días' },
        { id:'DCbGM4mqEVw', title:'Science & Innovation Report 2024', canal:'National Geographic', dur:'45:00', vistas:'1.2M visualizaciones', hace:'hace 5 días' },
    ],
};

const COLORS = ['#065fd4','#e91e8c','#ff5722','#4caf50','#9c27b0','#ff9800','#00bcd4','#f44336'];
const TODOS = Object.values(DB).flat();

function getColor(canal) {
    let h = 0; for (let c of canal) h = c.charCodeAt(0) + h;
    return COLORS[h % COLORS.length];
}

function renderCards(videos) {
    const grid = document.getElementById('grid');
    grid.innerHTML = videos.map((v, i) => `
        <div class="card" style="animation-delay:${i*0.03}s" onclick="abrirVideo('${v.id}',\`${v.title.replace(/`/g,"'")}\`,'${v.canal}')">
            <div class="thumb-wrap">
                <img src="https://img.youtube.com/vi/${v.id}/mqdefault.jpg" alt="${v.title}" loading="lazy"
                     onerror="this.src='https://placehold.co/320x180/e5e5e5/aaa?text=Video'">
                ${v.dur === 'LIVE'
                    ? '<span class="live-badge">● EN VIVO</span>'
                    : `<span class="dur-badge">${v.dur}</span>`}
            </div>
            <div class="card-info">
                <div class="avatar" style="background:${getColor(v.canal)}">${v.canal.charAt(0)}</div>
                <div class="card-meta">
                    <div class="card-title">${v.title}</div>
                    <div class="card-channel">${v.canal}</div>
                    <div class="card-stats">${v.vistas} · ${v.hace}</div>
                </div>
                <button class="more-btn" onclick="event.stopPropagation()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg>
                </button>
            </div>
        </div>`).join('');
}

function filtrar(cat, btn) {
    document.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById('q').value = '';
    document.getElementById('search-label').classList.remove('visible');
    renderCards(cat === 'todos' ? TODOS : DB[cat] || TODOS);
}

function filtrarChip(cat) {
    const chips = document.querySelectorAll('.chip');
    chips.forEach(c => c.classList.remove('active'));
    renderCards(DB[cat] || TODOS);
    document.getElementById('search-label').classList.remove('visible');
}

function buscar() {
    const q = document.getElementById('q').value.trim().toLowerCase();
    if (!q) return;
    document.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
    const label = document.getElementById('search-label');
    label.textContent = `Resultados de búsqueda para "${document.getElementById('q').value.trim()}"`;
    label.classList.add('visible');
    const filtrados = TODOS.filter(v => v.title.toLowerCase().includes(q) || v.canal.toLowerCase().includes(q));
    renderCards(filtrados.length ? filtrados : getVideosPorTema(q));
}

function getVideosPorTema(q) {
    if (q.includes('lofi')||q.includes('música')||q.includes('music')||q.includes('martinez')||q.includes('luna')) return DB.lofi;
    if (q.includes('php')||q.includes('programac')||q.includes('cod')) return DB.php;
    if (q.includes('cocina')||q.includes('receta')||q.includes('comida')) return DB.cocina;
    if (q.includes('naturaleza')||q.includes('nature')||q.includes('relax')) return DB.naturaleza;
    if (q.includes('tecno')||q.includes('tech')||q.includes('js')||q.includes('ai')) return DB.tecnologia;
    if (q.includes('juego')||q.includes('gaming')||q.includes('game')) return DB.gaming;
    return TODOS;
}

function abrirVideo(id, title, canal) {
    document.getElementById('modal-title').textContent = title;
    document.getElementById('modal-channel').textContent = canal;
    document.getElementById('yt-frame').src = `https://www.youtube.com/embed/${id}?autoplay=1`;
    document.getElementById('modal-link').href = `https://www.youtube.com/watch?v=${id}`;
    document.getElementById('modal-bg').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function cerrarModal() {
    document.getElementById('yt-frame').src = '';
    document.getElementById('modal-bg').classList.remove('open');
    document.body.style.overflow = '';
}

document.getElementById('btn-cerrar').onclick = cerrarModal;
document.getElementById('modal-bg').addEventListener('click', e => { if (e.target === e.currentTarget) cerrarModal(); });
document.addEventListener('keydown', e => { if (e.key === 'Escape') cerrarModal(); });

setTimeout(() => renderCards(TODOS), 300);
</script>
</body>
</html>
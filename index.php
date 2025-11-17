<?php $config = include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookSleuth - Literary Investigation Bureau</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="Identify books from your bookshelf photos using AI. Simply take a photo and our literary detectives will catalog every volume with precision.">
    <meta name="keywords" content="book identification, bookshelf scanner, AI book catalog, identify books, book detective">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://booksleuth.pics/">
    <meta property="og:title" content="BookSleuth - Literary Investigation Bureau">
    <meta property="og:description" content="Identify books from your bookshelf photos. Our AI literary detectives catalog every volume with precision.">
    <meta property="og:image" content="https://booksleuth.pics/booksleuth-og.webp">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:type" content="image/webp">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://booksleuth.pics/">
    <meta property="twitter:title" content="BookSleuth - Literary Investigation Bureau">
    <meta property="twitter:description" content="Identify books from your bookshelf photos. Our AI literary detectives catalog every volume with precision.">
    <meta property="twitter:image" content="https://booksleuth.pics/booksleuth-og.webp">

    <style>
        /* Local Fonts */
        @font-face {
            font-family: 'Crimson Text';
            font-style: normal;
            font-weight: 400;
            src: url('fonts/crimson-text-v19-latin-regular.woff2') format('woff2');
            font-display: swap;
        }

        @font-face {
            font-family: 'Crimson Text';
            font-style: normal;
            font-weight: 600;
            src: url('fonts/crimson-text-v19-latin-600.woff2') format('woff2');
            font-display: swap;
        }

        @font-face {
            font-family: 'Crimson Text';
            font-style: normal;
            font-weight: 700;
            src: url('fonts/crimson-text-v19-latin-700.woff2') format('woff2');
            font-display: swap;
        }

        @font-face {
            font-family: 'Courier Prime';
            font-style: normal;
            font-weight: 400;
            src: url('fonts/courier-prime-v7-latin-regular.woff2') format('woff2');
            font-display: swap;
        }

        @font-face {
            font-family: 'Courier Prime';
            font-style: normal;
            font-weight: 700;
            src: url('fonts/courier-prime-v7-latin-700.woff2') format('woff2');
            font-display: swap;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --parchment: #f4e8d0;
            --aged-paper: #e8dcc4;
            --ink-dark: #2b1810;
            --ink-medium: #5c4033;
            --gold: #c9a961;
            --gold-dark: #a68542;
            --sepia: #704214;
            --red-seal: #8b2e2e;
        }

        body {
            font-family: 'Courier Prime', monospace;
            background: var(--parchment);
            background-image:
                radial-gradient(circle at 20% 50%, rgba(194, 153, 107, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(139, 69, 19, 0.02) 0%, transparent 50%),
                url("data:image/svg+xml,%3Csvg width='100' height='100' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' /%3E%3C/filter%3E%3Crect width='100' height='100' filter='url(%23noise)' opacity='0.05'/%3E%3C/svg%3E");
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
        }

        /* Vintage paper texture overlay */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: repeating-linear-gradient(
                0deg,
                transparent,
                transparent 2px,
                rgba(139, 69, 19, 0.01) 2px,
                rgba(139, 69, 19, 0.01) 4px
            );
            pointer-events: none;
            z-index: 1;
        }

        .container {
            background: linear-gradient(to bottom, var(--aged-paper), var(--parchment));
            border: 3px solid var(--ink-dark);
            box-shadow:
                0 0 0 1px var(--gold),
                0 0 0 8px var(--aged-paper),
                0 0 0 11px var(--ink-dark),
                0 30px 60px rgba(43, 24, 16, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            max-width: 700px;
            width: 100%;
            position: relative;
            z-index: 2;
        }

        /* Art deco corner ornaments */
        .container::before,
        .container::after {
            content: '';
            position: absolute;
            width: 40px;
            height: 40px;
            border: 2px solid var(--gold);
        }

        .container::before {
            top: 15px;
            left: 15px;
            border-right: none;
            border-bottom: none;
        }

        .container::after {
            bottom: 15px;
            right: 15px;
            border-left: none;
            border-top: none;
        }

        .header {
            background: var(--ink-dark);
            color: var(--parchment);
            padding: 50px 40px 40px;
            text-align: center;
            position: relative;
            border-bottom: 4px double var(--gold);
        }

        .header::before {
            content: '🔍';
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 2em;
            filter: sepia(1) hue-rotate(-10deg) saturate(1.5);
        }

        .header h1 {
            font-family: 'Crimson Text', serif;
            font-size: 3em;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            text-shadow: 2px 2px 0 rgba(0, 0, 0, 0.3);
        }

        .header p {
            font-size: 0.95em;
            opacity: 0.9;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--gold);
            font-weight: 400;
        }

        .content {
            padding: 40px;
            position: relative;
        }

        /* Decorative divider */
        .content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(to right, transparent, var(--gold), transparent);
        }

        /* Landing Page */
        .landing-page {
            text-align: center;
            padding-top: 20px;
        }

        .landing-page.hidden {
            display: none;
        }

        .intro-text {
            color: var(--ink-medium);
            font-size: 1.1em;
            margin-bottom: 40px;
            line-height: 1.8;
            font-family: 'Courier Prime', monospace;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .case-number {
            display: inline-block;
            background: var(--ink-dark);
            color: var(--gold);
            padding: 8px 20px;
            margin-bottom: 30px;
            border: 1px solid var(--gold);
            font-size: 0.85em;
            letter-spacing: 0.15em;
            font-weight: bold;
        }

        .primary-btn {
            background: var(--ink-dark);
            color: var(--parchment);
            border: 3px solid var(--gold);
            padding: 18px 50px;
            font-size: 1.1em;
            font-family: 'Crimson Text', serif;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(43, 24, 16, 0.2);
        }

        .primary-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(201, 169, 97, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .primary-btn:hover::before {
            left: 100%;
        }

        .primary-btn:hover {
            background: var(--sepia);
            box-shadow: 0 6px 20px rgba(43, 24, 16, 0.3);
            transform: translateY(-2px);
        }

        .primary-btn:active {
            transform: translateY(0);
        }

        /* Photo Upload Section */
        .upload-section {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .upload-section.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .photo-count {
            text-align: center;
            color: var(--ink-medium);
            font-size: 0.9em;
            margin-bottom: 20px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 10px;
            background: rgba(92, 64, 51, 0.05);
            border-top: 1px solid var(--gold);
            border-bottom: 1px solid var(--gold);
        }

        .photo-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }

        .photo-item {
            position: relative;
            background: rgba(255, 255, 255, 0.3);
            border: 2px dashed var(--ink-medium);
            overflow: hidden;
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .photo-item.filled {
            border: 3px solid var(--ink-dark);
            background: var(--aged-paper);
            box-shadow: inset 0 0 20px rgba(43, 24, 16, 0.1);
        }

        .photo-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: sepia(0.15) contrast(1.1);
        }

        .photo-item .remove-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            background: var(--red-seal);
            color: var(--parchment);
            border: 2px solid var(--parchment);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.2em;
            font-weight: bold;
            opacity: 0;
            transition: opacity 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .photo-item.filled:hover .remove-btn {
            opacity: 1;
        }

        .add-photo-slot {
            border: 2px dashed var(--gold);
            color: var(--ink-medium);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-family: 'Crimson Text', serif;
            font-size: 1.1em;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(201, 169, 97, 0.05) 10px,
                rgba(201, 169, 97, 0.05) 20px
            );
        }

        .add-photo-slot:hover {
            background: rgba(201, 169, 97, 0.15);
            border-color: var(--gold-dark);
            color: var(--ink-dark);
        }

        .add-photo-slot.disabled {
            opacity: 0.3;
            cursor: not-allowed;
            border-color: var(--ink-medium);
            color: var(--ink-medium);
        }

        .add-photo-slot.disabled:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .hidden-input {
            display: none;
        }

        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .secondary-btn {
            flex: 1;
            background: transparent;
            color: var(--ink-dark);
            border: 2px solid var(--ink-dark);
            padding: 14px 25px;
            font-size: 1em;
            font-family: 'Courier Prime', monospace;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .secondary-btn:hover {
            background: var(--ink-dark);
            color: var(--parchment);
        }

        .secondary-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .analyze-btn {
            flex: 1;
            background: var(--ink-dark);
            color: var(--gold);
            border: 3px solid var(--gold);
            padding: 14px 25px;
            font-size: 1em;
            font-family: 'Crimson Text', serif;
            cursor: pointer;
            font-weight: 700;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            position: relative;
        }

        .analyze-btn:hover:not(:disabled) {
            background: var(--sepia);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(43, 24, 16, 0.3);
        }

        .analyze-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        /* Loading Animation */
        .loading-section {
            display: none;
            text-align: center;
            padding: 60px 20px;
            animation: fadeIn 0.5s ease;
        }

        .loading-section.active {
            display: block;
        }

        .magnifying-glass {
            width: 100px;
            height: 100px;
            margin: 0 auto 30px;
            position: relative;
            animation: investigate 2s ease-in-out infinite;
        }

        @keyframes investigate {
            0%, 100% { transform: rotate(-10deg) translateX(-10px); }
            50% { transform: rotate(10deg) translateX(10px); }
        }

        .magnifying-glass::before {
            content: '🔍';
            font-size: 80px;
            filter: sepia(0.5) hue-rotate(-10deg);
        }

        .loading-text {
            color: var(--ink-dark);
            font-weight: 600;
            font-size: 1.2em;
            margin-top: 20px;
            font-family: 'Crimson Text', serif;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .loading-dots {
            display: inline-block;
            animation: dots 1.5s infinite;
        }

        @keyframes dots {
            0%, 20% { content: '.'; }
            40% { content: '..'; }
            60%, 100% { content: '...'; }
        }

        .loading-subtext {
            color: var(--ink-medium);
            font-size: 0.9em;
            margin-top: 10px;
            font-style: italic;
        }

        /* Results Section */
        .results-section {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .results-section.active {
            display: block;
        }

        .results-header {
            margin-bottom: 30px;
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 2px solid var(--gold);
        }

        .results-header h2 {
            font-family: 'Crimson Text', serif;
            color: var(--ink-dark);
            margin-bottom: 10px;
            font-size: 2em;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .book-count {
            color: var(--ink-medium);
            font-size: 0.95em;
            letter-spacing: 0.15em;
            text-transform: uppercase;
        }

        .case-closed {
            display: inline-block;
            background: var(--red-seal);
            color: var(--parchment);
            padding: 6px 15px;
            margin-top: 10px;
            font-size: 0.8em;
            letter-spacing: 0.2em;
            font-weight: bold;
            transform: rotate(-2deg);
            box-shadow: 0 2px 8px rgba(139, 46, 46, 0.3);
        }

        /* Library card catalog style table */
        .results-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            background: var(--aged-paper);
            border: 2px solid var(--ink-dark);
            box-shadow: inset 0 0 30px rgba(43, 24, 16, 0.05);
        }

        .results-table thead {
            background: var(--ink-dark);
            color: var(--gold);
        }

        .results-table thead tr {
            display: table-row;
        }

        .results-table th {
            display: table-cell;
            padding: 15px;
            text-align: left;
            font-weight: 700;
            font-family: 'Crimson Text', serif;
            font-size: 1.1em;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            border-bottom: 3px double var(--gold);
            white-space: nowrap;
        }

        .results-table td {
            display: table-cell;
            padding: 15px;
            border-bottom: 1px solid var(--gold);
            color: var(--ink-dark);
            font-family: 'Courier Prime', monospace;
            font-size: 0.95em;
        }

        .results-table tr:last-child td {
            border-bottom: none;
        }

        .results-table tbody tr {
            display: table-row;
            transition: background 0.2s, border-left 0.2s;
        }

        .results-table tbody tr:hover {
            background: rgba(201, 169, 97, 0.1);
            border-left: 4px solid var(--gold);
        }

        .results-table th:last-child,
        .results-table td:last-child {
            text-align: center;
            width: 60px;
        }

        .zlib-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            background: #6b9bb3;
            color: white;
            text-decoration: none;
            font-family: 'Courier Prime', monospace;
            font-weight: bold;
            font-size: 18px;
            border: 2px solid #5a8a9f;
            transition: all 0.2s;
            box-shadow: 0 2px 4px rgba(107, 155, 179, 0.3);
        }

        .zlib-link:hover {
            background: #5a8a9f;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(107, 155, 179, 0.4);
        }

        .zlib-link:active {
            transform: translateY(0);
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            flex-direction: column;
        }

        @media (min-width: 480px) {
            .action-buttons {
                flex-direction: row;
            }
        }

        .action-btn {
            flex: 1;
            padding: 16px 25px;
            border: none;
            cursor: pointer;
            font-weight: 700;
            font-size: 1em;
            transition: all 0.3s;
            font-family: 'Courier Prime', monospace;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .download-btn {
            background: var(--ink-dark);
            color: var(--gold);
            border: 3px solid var(--gold);
        }

        .download-btn:hover {
            background: var(--sepia);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(43, 24, 16, 0.3);
        }

        .restart-btn {
            background: transparent;
            color: var(--ink-dark);
            border: 2px solid var(--ink-dark);
        }

        .restart-btn:hover {
            background: var(--ink-dark);
            color: var(--parchment);
        }

        /* Error Messages */
        .error-message {
            background: var(--red-seal);
            color: var(--parchment);
            padding: 15px;
            margin-bottom: 20px;
            border: 2px solid var(--ink-dark);
            box-shadow: 0 4px 12px rgba(139, 46, 46, 0.3);
            font-family: 'Courier Prime', monospace;
            animation: shake 0.5s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .header h1 {
                font-size: 2em;
            }

            .header {
                padding: 40px 25px 30px;
            }

            .content {
                padding: 30px 25px;
            }

            .results-table {
                font-size: 0.85em;
            }

            .results-table th,
            .results-table td {
                padding: 10px;
            }

            .container::before,
            .container::after {
                width: 25px;
                height: 25px;
            }

            .container::before {
                top: 10px;
                left: 10px;
            }

            .container::after {
                bottom: 10px;
                right: 10px;
            }
        }

        /* Typewriter effect for loading */
        @keyframes typewriter {
            from { width: 0; }
            to { width: 100%; }
        }
    </style>
    <script defer src="https://umami.rowe.ovh/script.js" data-website-id="1e39f950-1aa7-4dbe-9af1-47f8ca0fcf98"></script>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>BookSleuth</h1>
            <p>Literary Investigation Bureau</p>
        </div>

        <div class="content">
            <!-- Landing Page -->
            <div class="landing-page">
                <div class="case-number">CASE FILE: NEW INVESTIGATION</div>
                <p class="intro-text">
                    Submit photographic evidence of your bookshelf. Our literary detectives will analyze and catalog every volume with precision.
                </p>
                <button class="primary-btn" onclick="startUpload()">📸 Begin Investigation</button>
            </div>

            <!-- Photo Upload Section -->
            <div class="upload-section">
                <div class="photo-count" id="photoCount">0 / 4 EVIDENCE PHOTOS</div>
                <div class="photo-grid" id="photoGrid"></div>
                <input type="file" id="fileInput" class="hidden-input" accept="image/*">

                <div class="button-group">
                    <button class="secondary-btn" onclick="cancelUpload()">Abandon Case</button>
                    <button class="analyze-btn" id="analyzeBtn" onclick="submitPhotos()" disabled>
                        Analyze Evidence
                    </button>
                </div>
            </div>

            <!-- Loading Section -->
            <div class="loading-section">
                <div class="magnifying-glass"></div>
                <p class="loading-text">Investigating<span class="loading-dots">...</span></p>
                <p class="loading-subtext">Examining literary evidence</p>
            </div>

            <!-- Results Section -->
            <div class="results-section">
                <div class="results-header">
                    <h2 id="resultsTitle">Case Report</h2>
                    <p class="book-count" id="bookCount"></p>
                    <div class="case-closed">INVESTIGATION COMPLETE</div>
                </div>
                <table class="results-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Search</th>
                        </tr>
                    </thead>
                    <tbody id="resultsBody">
                    </tbody>
                </table>
                <div class="action-buttons">
                    <button class="action-btn download-btn" onclick="downloadCSV()">📥 Export Records</button>
                    <button class="action-btn restart-btn" onclick="startOver()">🔄 New Case</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Configuration
        const CONFIG = {
            MAX_PHOTOS: 4,
            MAX_FILE_SIZE: 10 * 1024 * 1024, // 10MB
            COMPRESSION_QUALITY: 0.85,
            MAX_WIDTH: 1920,
            N8N_WEBHOOK_URL: '<?php echo $config['N8N_WEBHOOK_URL']; ?>',
        };

        // State
        let photos = [];
        let currentResults = null;

        // Start upload flow
        function startUpload() {
            document.querySelector('.landing-page').classList.add('hidden');
            document.querySelector('.upload-section').classList.add('active');
            initializePhotoGrid();
        }

        // Initialize photo grid
        function initializePhotoGrid() {
            const grid = document.getElementById('photoGrid');
            grid.innerHTML = '';

            for (let i = 0; i < CONFIG.MAX_PHOTOS; i++) {
                const photoItem = document.createElement('div');
                photoItem.className = 'photo-item';
                photoItem.id = `photo-${i}`;

                if (photos[i]) {
                    photoItem.classList.add('filled');
                    photoItem.innerHTML = `
                        <img src="${photos[i].base64}" alt="Photo ${i + 1}">
                        <button class="remove-btn" onclick="removePhoto(${i})">×</button>
                    `;
                } else if (photos.length < CONFIG.MAX_PHOTOS) {
                    photoItem.classList.add('add-photo-slot');
                    photoItem.innerHTML = '+ Add Evidence';
                    photoItem.onclick = () => document.getElementById('fileInput').click();
                }

                grid.appendChild(photoItem);
            }

            updatePhotoCount();
        }

        // Handle file input
        document.getElementById('fileInput').addEventListener('change', async (e) => {
            const file = e.target.files[0];
            if (file) {
                const error = validateFile(file);
                if (error) {
                    showError(error);
                    document.getElementById('fileInput').value = '';
                    return;
                }

                try {
                    const compressedBase64 = await compressImage(file);
                    photos.push({
                        id: `img_${photos.length + 1}`,
                        base64: compressedBase64,
                        fileName: file.name,
                        timestamp: Date.now()
                    });

                    initializePhotoGrid();
                    document.getElementById('fileInput').value = '';
                } catch (err) {
                    showError('Failed to process image. Please try again.');
                }
            }
        });

        // Validate file
        function validateFile(file) {
            if (file.size > CONFIG.MAX_FILE_SIZE) {
                return 'File size exceeds 10MB limit.';
            }

            if (!file.type.startsWith('image/')) {
                return 'Please select a valid image file.';
            }

            return null;
        }

        // Compress image
        function compressImage(file) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const img = new Image();
                    img.onload = () => {
                        const canvas = document.createElement('canvas');
                        let { width, height } = img;

                        if (width > CONFIG.MAX_WIDTH) {
                            height = Math.round((height * CONFIG.MAX_WIDTH) / width);
                            width = CONFIG.MAX_WIDTH;
                        }

                        canvas.width = width;
                        canvas.height = height;
                        const ctx = canvas.getContext('2d');
                        ctx.drawImage(img, 0, 0, width, height);

                        const compressedBase64 = canvas.toDataURL('image/jpeg', CONFIG.COMPRESSION_QUALITY);
                        resolve(compressedBase64);
                    };
                    img.onerror = () => reject(new Error('Failed to load image'));
                    img.src = e.target.result;
                };
                reader.onerror = () => reject(new Error('Failed to read file'));
                reader.readAsDataURL(file);
            });
        }

        // Remove photo
        function removePhoto(index) {
            photos.splice(index, 1);
            initializePhotoGrid();
        }

        // Update photo count
        function updatePhotoCount() {
            const count = photos.length;
            document.getElementById('photoCount').textContent = `${count} / ${CONFIG.MAX_PHOTOS} EVIDENCE PHOTOS`;
            document.getElementById('analyzeBtn').disabled = count === 0;
        }

        // Cancel upload
        function cancelUpload() {
            photos = [];
            document.querySelector('.landing-page').classList.remove('hidden');
            document.querySelector('.upload-section').classList.remove('active');
        }

        // Submit photos
        async function submitPhotos() {
            if (photos.length === 0) return;

            const payload = {
                images: photos.map(p => ({
                    id: p.id,
                    data: p.base64,
                    fileName: p.fileName
                })),
                action: 'analyze'
            };

            showLoadingState();

            try {
                const response = await fetch(CONFIG.N8N_WEBHOOK_URL, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();

                if (data.success) {
                    currentResults = data.books;
                    displayResults(data.books, data.metadata);
                } else {
                    showError(data.error || 'Failed to analyze photos');
                    showUploadState();
                }
            } catch (error) {
                showError('Connection error. Please check your internet and try again.');
                showUploadState();
            }
        }

        // Show loading state
        function showLoadingState() {
            document.querySelector('.upload-section').classList.remove('active');
            document.querySelector('.loading-section').classList.add('active');
        }

        // Show upload state
        function showUploadState() {
            document.querySelector('.loading-section').classList.remove('active');
            document.querySelector('.upload-section').classList.add('active');
        }

        // Generate Z-Library search URL
        function generateZLibUrl(title, author) {
            // Combine title and author
            const searchQuery = `${title} ${author}`;

            // Remove special characters (keep only alphanumeric and spaces)
            const sanitized = searchQuery
                .replace(/[;.,\-_'""`''""—–()[\]{}!?:/\\]/g, ' ')  // Replace special chars with space
                .replace(/\s+/g, ' ')  // Collapse multiple spaces
                .trim();

            // URL encode for PHP redirect
            const encoded = encodeURIComponent(sanitized);

            // Use PHP redirect instead of direct link
            return `https://booksleuth.pics/search.php?q=${encoded}`;
        }

        // Display results
        function displayResults(books, metadata) {
            document.querySelector('.loading-section').classList.remove('active');
            document.querySelector('.results-section').classList.add('active');

            const bookText = books.length === 1 ? 'volume' : 'volumes';
            document.getElementById('bookCount').textContent = `${books.length} ${bookText} identified`;

            const tbody = document.getElementById('resultsBody');
            tbody.innerHTML = '';

            books.forEach(book => {
                const row = document.createElement('tr');
                const zlibUrl = generateZLibUrl(book.title, book.author);
                row.innerHTML = `
                    <td>${escapeHtml(book.title)}</td>
                    <td>${escapeHtml(book.author)}</td>
                    <td><a href="${zlibUrl}" target="_blank" class="zlib-link" rel="noopener noreferrer">z</a></td>
                `;
                tbody.appendChild(row);
            });
        }

        // Download CSV
        function downloadCSV() {
            if (!currentResults) return;

            let csv = 'Title,Author\n';
            currentResults.forEach(book => {
                const title = `"${book.title.replace(/"/g, '""')}"`;
                const author = `"${book.author.replace(/"/g, '""')}"`;
                csv += `${title},${author}\n`;
            });

            const blob = new Blob([csv], { type: 'text/csv' });
            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.href = url;
            link.download = `booksleuth-case-${new Date().toISOString().split('T')[0]}.csv`;
            link.click();
            URL.revokeObjectURL(url);
        }

        // Start over
        function startOver() {
            photos = [];
            currentResults = null;
            document.querySelector('.results-section').classList.remove('active');
            document.querySelector('.landing-page').classList.remove('hidden');
        }

        // Show error message
        function showError(message) {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            errorDiv.textContent = `⚠ INVESTIGATION ERROR: ${message}`;
            document.querySelector('.content').insertBefore(errorDiv, document.querySelector('.content').firstChild);

            setTimeout(() => {
                errorDiv.remove();
            }, 5000);
        }

        // Escape HTML to prevent XSS
        function escapeHtml(text) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return text.replace(/[&<>"']/g, m => map[m]);
        }
    </script>
</body>
</html>

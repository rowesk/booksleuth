# BookSleuth - Literary Investigation Bureau

A vintage-themed web application that uses AI to identify books from bookshelf photos. Upload up to 4 images of your bookshelves, and BookSleuth will catalog every visible title and author with precision.

![BookSleuth](booksleuth-og.webp)

## Features

- 📸 **Multi-Image Upload** - Submit up to 4 bookshelf photos at once
- 🤖 **AI-Powered Detection** - GPT-5-mini analyzes images and extracts book information
- 🎨 **Vintage Detective Aesthetic** - 1920s library-inspired design with parchment textures and art deco elements
- 📥 **CSV Export** - Download your book catalog for importing into Goodreads, spreadsheets, etc.
- 🔍 **Direct Search Integration** - One-click search links for each identified book
- ⚡ **Client-Side Compression** - Images compressed to JPEG before upload (max 1920px, 85% quality)
- 🔒 **Privacy-Focused** - Self-hosted fonts, minimal external dependencies
- 📱 **Mobile-Friendly** - Responsive design works on all devices

## Tech Stack

**Frontend:**
- Pure HTML5, CSS3, and vanilla JavaScript (no frameworks)
- Self-hosted Google Fonts (Crimson Text + Courier Prime)
- Canvas API for image compression

**Backend:**
- n8n workflow automation for orchestration
- GPT-5-mini API for book identification
- PHP redirect script (optional, for search links)

**Infrastructure:**
- Static HTML hosting (no build process required)
- Works on any web server with PHP support

## How It Works

1. **Image Upload** - User selects 1-4 bookshelf photos
2. **Client-Side Processing** - Images are compressed and converted to base64
3. **n8n Workflow** - Images sent to n8n webhook endpoint
4. **Parallel Processing** - n8n splits images and processes them concurrently through GPT-5-mini
5. **AI Analysis** - GPT-5-mini identifies visible book titles and authors from each image
6. **Aggregation** - Results are combined, deduplicated, and sorted alphabetically
7. **Display** - Books shown in a vintage library card catalog-style table

## Setup Instructions

### Prerequisites

- A web server with PHP support (for the search redirect)
- n8n instance (self-hosted or cloud)
- OpenAI API key (for GPT-5-mini access)

### Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/yourusername/booksleuth.git
   cd booksleuth
   ```

2. **Download font files:**
   - Visit [google-webfonts-helper](https://gwfh.mranftl.com/fonts)
   - Download Crimson Text (400, 600, 700) and Courier Prime (400, 700)
   - Extract to the `fonts/` directory

3. **Configure webhook URL:**
   ```bash
   # Copy the example config
   cp config.example.php config.php

   # Edit config.php and update your n8n webhook URL
   nano config.php
   ```

4. **Set up .gitignore:**
   Create a `.gitignore` file to prevent committing sensitive config:
   ```
   config.php
   ```

5. **Set up the n8n workflow** (see below)

6. **Deploy to your web server:**
   ```bash
   # Upload these files to your web root:
   - index.php (note: PHP file, not HTML)
   - config.php (your actual config with webhook URL)
   - search.php
   - booksleuth-og.webp
   - fonts/

   # For Git repository, commit:
   - index.php
   - config.example.php (template for others)
   - search.php
   - booksleuth-og.webp
   - fonts/

   # DO NOT commit config.php (add to .gitignore)
   ```

### n8n Workflow Setup

Create a workflow with the following nodes:

1. **Webhook** - Receives image data from frontend
2. **Code Node** - Splits images into separate items for parallel processing
3. **HTTP Request Nodes** - Calls GPT-5-mini API for each image
4. **Code Node** - Extracts book data from GPT responses
5. **Aggregate Node** - Combines all results
6. **Code Node** - Deduplicates books and formats response
7. **Response Node** - Returns JSON with CORS headers

See `n8n-webhook-input.txt` for example input format.

## Configuration

### Update Webhook URL

The webhook URL is stored in `config.php` (not tracked in Git). To change it:

```bash
# Edit config.php
nano config.php
```

```php
<?php
return [
    'N8N_WEBHOOK_URL' => 'https://your-n8n-instance.com/webhook/your-endpoint'
];
?>
```

**Security Note:** The `config.php` file should be added to `.gitignore` to keep your webhook URL private. Use `config.example.php` as a template for others.

### Customize Search Provider

By default, search links use Z-Library via PHP redirect. To use a different provider:

```javascript
// In generateZLibUrl() function (line 965)
function generateZLibUrl(title, author) {
    const query = encodeURIComponent(`${title} ${author}`);

    // Google Books:
    return `https://www.google.com/search?tbm=bks&q=${query}`;

    // Or Goodreads:
    return `https://www.goodreads.com/search?q=${query}`;
}
```

## File Structure

```
booksleuth/
├── index.php               # Main application (PHP file for config injection)
├── config.php              # Configuration (webhook URL) - NOT IN GIT
├── config.example.php      # Configuration template for Git
├── search.php              # PHP redirect for book searches
├── booksleuth-og.webp      # Social media preview image
├── .gitignore              # Excludes config.php
├── fonts/                  # Self-hosted font files
│   ├── crimson-text-v19-latin-regular.woff2
│   ├── crimson-text-v19-latin-600.woff2
│   ├── crimson-text-v19-latin-700.woff2
│   ├── courier-prime-v7-latin-regular.woff2
│   └── courier-prime-v7-latin-700.woff2
├── tasklist.md             # Development notes
├── systemprompt.txt        # GPT prompt for book identification
└── README.md               # This file
```

## Design Philosophy

BookSleuth uses a **1920s detective/library aesthetic**:

- **Color Palette**: Parchment (#f4e8d0), aged paper (#e8dcc4), ink dark (#2b1810), gold accents (#c9a961)
- **Typography**: Crimson Text serif for headers, Courier Prime monospace for body
- **Visual Elements**: Art deco corner ornaments, vintage paper textures, library card catalog styling
- **Terminology**: "Literary Investigation Bureau", "Case File", "Evidence Photos"

## Performance Optimizations

- **Local Fonts**: No external font requests (Google Fonts self-hosted)
- **Image Compression**: Client-side JPEG compression before upload
- **Minimal Dependencies**: Only 1 external script (Umami analytics, optional)
- **CSS Inlining**: All styles embedded in HTML

## Known Limitations

- **Cloudflare Timeout**: Processing 4 images can take 2-3 minutes, which may exceed Cloudflare's 100-second proxy timeout. Consider using DNS-only (grey cloud) or implementing async polling.
- **AI Accuracy**: GPT-5-mini may occasionally misread titles or miss books with poor or partial visibility
- **Norton Blocking**: Some security software may block Z-Library search links (even with PHP redirect)

## Browser Compatibility

- Chrome/Edge 90+
- Firefox 88+
- Safari 14+
- Mobile browsers (iOS Safari, Chrome Mobile)

## Contributing

Contributions welcome! Please feel free to submit a Pull Request.

## License

MIT License - feel free to use this project for personal or commercial purposes.

## Credits

- Design inspiration: 1920s detective novels and library card catalogs
- Fonts: [Crimson Text](https://fonts.google.com/specimen/Crimson+Text) by Sebastian Kosch, [Courier Prime](https://fonts.google.com/specimen/Courier+Prime) by Alan Dague-Greene
- AI: OpenAI GPT-5-mini
- Workflow: n8n

## Support

For issues or questions, please [open an issue](https://github.com/yourusername/booksleuth/issues) on GitHub.

---

**Built with ❤️ for book lovers everywhere**

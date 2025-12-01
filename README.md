<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ktebloop – Share Your Books for Free</title>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #fefefe;
      color: #333;
      line-height: 1.6;
      margin: 0;
      padding: 2rem;
    }
    h1, h2, h3 {
      color: #2f855a; /* Green for eco-friendly feel */
    }
    h1 {
      font-size: 2.5rem;
      margin-bottom: 0.5rem;
    }
    h2 {
      font-size: 2rem;
      margin-top: 2rem;
      margin-bottom: 1rem;
    }
    h3 {
      font-size: 1.5rem;
      margin-top: 1.5rem;
    }
    p {
      margin: 0.5rem 0 1rem 0;
    }
    ul {
      list-style-type: disc;
      padding-left: 1.5rem;
    }
    code {
      background-color: #f0f0f0;
      padding: 0.2rem 0.4rem;
      border-radius: 4px;
      font-family: monospace;
    }
    pre {
      background-color: #f0f0f0;
      padding: 1rem;
      border-radius: 6px;
      overflow-x: auto;
    }
    hr {
      border: none;
      height: 2px;
      background-color: #2f855a;
      margin: 2rem 0;
    }
    img {
      max-width: 100%;
      display: block;
      margin: 1rem 0;
      border-radius: 8px;
    }
    .section {
      margin-bottom: 2rem;
    }
  </style>
</head>
<body>
  <h1>📚 Ktebloop – Share Your Books for Free</h1>
  <p>Ktebloop is a Laravel PHP web platform to share, exchange, and discover books for free.<br>
     Join an eco-friendly community and give your books a second life! 🌱✨</p>
  <img src="/demo.gif" alt="Ktebloop Demo">
  <hr>

  <div class="section">
    <h2>🚀 Main Features</h2>

    <h3>📖 Book Sharing</h3>
    <ul>
      <li>Easily publish your books</li>
      <li>Intuitive interface for managing your publications</li>
    </ul>

    <h3>🔍 Smart Discovery</h3>
    <ul>
      <li>Search by keywords</li>
      <li>Filter by categories</li>
      <li>Personalized book suggestions</li>
    </ul>

    <h3>🤝 Exchanges & Community</h3>
    <ul>
      <li>Meet members with similar tastes</li>
      <li>Exchange books locally or online</li>
    </ul>

    <h3>🌿 Eco-Friendly Impact</h3>
    <ul>
      <li>Reduce waste</li>
      <li>Promote circular economy</li>
      <li>Encourage reuse and sharing</li>
    </ul>
  </div>

  <div class="section">
    <h2>🖥️ Technologies Used</h2>
    <ul>
      <li><strong>Backend:</strong> PHP 8, Laravel 10</li>
      <li><strong>Frontend:</strong> HTML5, CSS3, custom Tailwind-like styles</li>
      <li><strong>Database:</strong> MySQL / MariaDB</li>
      <li><strong>Authentication:</strong> Laravel Breeze</li>
      <li><strong>Icons & Fonts:</strong> Font Awesome, Google Fonts Inter</li>
    </ul>
  </div>

  <div class="section">
    <h2>🎨 Design & UX</h2>
    <ul>
      <li>Interactive hero section with badge and stats</li>
      <li>Floating cards for main features</li>
      <li>Responsive design for mobile, tablet, and desktop</li>
      <li>Animations: fade-in, floating elements, hover effects</li>
      <li>Color palette: eco-friendly 🌿 (yellow, green, white)</li>
    </ul>
  </div>

  <div class="section">
    <h2>⚡ Installation & Running</h2>

    <h3>1. Clone the project</h3>
    <pre><code>git clone https://github.com/duzcoder/Ktebloop.git
cd Ktebloop</code></pre>

    <h3>2. Install PHP dependencies</h3>
    <pre><code>composer install</code></pre>

    <h3>3. Configure environment</h3>
    <pre><code>cp .env.example .env
php artisan key:generate</code></pre>
    <p>Edit <code>.env</code> to configure your database.</p>

    <h3>4. Run migrations</h3>
    <pre><code>php artisan migrate</code></pre>

    <h3>5. Start the server</h3>
    <pre><code>php artisan serve</code></pre>
    <p>Open <a href="http://127.0.0.1:8000" target="_blank">http://127.0.0.1:8000</a> in your browser</p>
  </div>
</body>
</html>

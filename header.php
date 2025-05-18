<?php
// Determine current page for active nav state
$current_page = basename($_SERVER['PHP_SELF'], '.php');
if ($current_page === 'index') {
    $current_page = 'home';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : "Jax Sod Inc. - Professional Sod Installation in Jacksonville, FL"; ?></title>
    <meta name="description" content="<?php echo isset($pageDescription) ? htmlspecialchars($pageDescription) : "Jacksonville's premier sod installation specialists with 40+ years of experience. Professional sod installation for residential and commercial properties. Free estimates."; ?>">
    
    <!-- Additional meta tags for SEO -->
    <meta name="robots" content="index, follow">
    <meta name="geo.region" content="US-FL">
    <meta name="geo.placename" content="Jacksonville">
    <link rel="canonical" href="https://jaxsod.com<?php echo $_SERVER['REQUEST_URI']; ?>">
    
    <!-- Open Graph tags for social sharing -->
    <meta property="og:title" content="<?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : "Jax Sod Inc. - Professional Sod Installation in Jacksonville, FL"; ?>">
    <meta property="og:description" content="<?php echo isset($pageDescription) ? htmlspecialchars($pageDescription) : "Jacksonville's premier sod installation specialists with 40+ years of experience. Professional sod installation for residential and commercial properties."; ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://jaxsod.com<?php echo $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:image" content="https://jaxsod.com/images/logo.png">
    <meta property="og:site_name" content="Jax Sod Inc.">
    <meta property="og:locale" content="en_US">
    
    <!-- Fonts (Assuming similar fonts are desired) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons (Required by old CSS) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Stylesheets (Combined main and search CSS) -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dropdown.css">
    <link rel="stylesheet" href="css/browser-fixes.css">
    <link rel="stylesheet" href="css/footer-fix.css">
    
    <!-- Schema.org structured data for Local Business -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "Jax Sod Inc.",
      "image": "https://jaxsod.com/images/logo.png",
      "url": "https://jaxsod.com",
      "telephone": "(904) 901-1457",
      "priceRange": "$$",
      "description": "Jacksonville's premier sod installation specialists with 40+ years of experience. Professional installation for residential and commercial properties.",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "123 Main Street",
        "addressLocality": "Jacksonville",
        "addressRegion": "FL",
        "postalCode": "32256",
        "addressCountry": "US"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": 30.3322,
        "longitude": -81.6557
      },
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday"
        ],
        "opens": "08:00",
        "closes": "17:00"
      },
      "sameAs": [
        "https://www.facebook.com/jaxsodinc",
        "https://www.instagram.com/jaxsodinc"
      ],
      "serviceArea": {
        "@type": "GeoCircle",
        "geoMidpoint": {
          "@type": "GeoCoordinates",
          "latitude": 30.3322,
          "longitude": -81.6557
        },
        "geoRadius": "50000"
      },
      "areaServed": ["Jacksonville", "St. Augustine", "Orange Park", "Ponte Vedra", "Middleburg", "Fernandina Beach"]
    }
    </script>
    
    <!-- JavaScript -->
    <script src="js/dropdown.js" defer></script>
</head>
<body class="page-<?php echo htmlspecialchars($current_page); ?>">
    <!-- Header -->
    <header class="site-header">
        <div class="container header-container">
            <div class="logo">
                <a href="index.php">
                    <!-- Placeholder for logo image if available -->
                    <!-- <img src="images/logo.png" alt="Jax Sod Inc. Logo - Professional Sod Installation in Jacksonville" width="50" height="50"> -->
                    <div class="logo-text">
                        <span class="logo-title">Jax Sod Inc.</span>
                        <span class="logo-tagline">Professional Sod Installation</span>
                    </div>
                </a>
            </div>
            
            <div class="contact-info">
                <a href="tel:9049011457" class="phone-number" aria-label="Call Jax Sod Inc. at 904-901-1457 for professional sod installation in Jacksonville">
                    <i class="fas fa-phone"></i> (904) 901-1457
                </a>
                <a href="contact.php" class="btn btn-primary btn-sm d-none d-md-inline-block">Get a Free Estimate</a>
            </div>
        </div>
    </header>
    
    <!-- Navigation -->
    <nav class="main-nav" role="navigation">
        <div class="container nav-container">
            <button class="mobile-menu-toggle" aria-label="Toggle mobile menu" aria-expanded="false">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="nav-menu">
                <li class="<?php echo $current_page === 'home' ? 'active' : ''; ?>">
                    <a href="index.php">Home</a>
                </li>
                <li class="<?php echo ($current_page === 'services' || $current_page === 'residential-sod-installation' || $current_page === 'commercial-sod-installation') ? 'active' : ''; ?> has-dropdown">
                    <a href="services.php">Services</a>
                    <ul class="dropdown-menu">
                        <li><a href="services.php">All Services</a></li>
                        <li><a href="residential-sod-installation.php">Residential Sod Installation</a></li>
                        <li><a href="commercial-sod-installation.php">Commercial Sod Installation</a></li>
                    </ul>
                </li>
                <li class="<?php echo $current_page === 'about' ? 'active' : ''; ?>">
                    <a href="about.php">About</a>
                </li>
                <li class="<?php echo ($current_page === 'articles' || $current_page === 'article' || $current_page === 'category' || $current_page === 'tag') ? 'active' : ''; ?> has-dropdown">
                    <a href="articles.php">Articles</a>
                    <ul class="dropdown-menu">
                        <li><a href="articles.php">All Articles</a></li>
                        <?php 
                        include_once('article_functions.php');
                        foreach ($categories as $slug => $category): ?>
                            <li><a href="category.php?category=<?php echo htmlspecialchars($slug); ?>"><?php echo htmlspecialchars($category['name']); ?> (<?php echo $category['count']; ?>)</a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="<?php echo $current_page === 'contact' ? 'active' : ''; ?>">
                    <a href="contact.php">Contact</a>
                </li>
            </ul>
            
            <!-- Search Form -->
            <div class="search-container" style="display: flex !important; visibility: visible !important;">
                <form action="search.php" method="get" class="search-form">
                    <div class="search-input-group">
                        <input type="text" name="q" placeholder="Search sod installation articles..." aria-label="Search articles" value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">
                        <button type="submit" class="search-button" aria-label="Submit search">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <!-- Start Main Content Area -->
    <main class="main-content">
<?php
require_once 'vendor/autoload.php';

$pageTitle = "Category Not Found - Jax Sod Inc.";
$categoryName = "Category Not Found";
$articleFiles = [];

if (isset($_GET['category'])) {
    // Sanitize the category name
    $category = preg_replace('/[^a-zA-Z0-9-]/', '', $_GET['category']);
    
    // Format category name for display (convert hyphens to spaces and capitalize)
    $categoryName = ucwords(str_replace('-', ' ', $category));
    
    // Set page title
    $pageTitle = $categoryName . " Articles - Jax Sod Inc.";
    
    // Check if category directory exists
    $categoryDir = "content/articles/" . $category . "/";
    if (is_dir($categoryDir)) {
        $articleFiles = glob($categoryDir . "*.md");
    }
}

// Pagination settings
$articlesPerPage = 10;
$totalArticles = count($articleFiles);
$totalPages = ceil($totalArticles / $articlesPerPage);
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($currentPage - 1) * $articlesPerPage;
$paginatedArticles = array_slice($articleFiles, $offset, $articlesPerPage);

include("header.php");
?>

<div class="container page-content">
    <h2><?php echo htmlspecialchars($categoryName); ?> Articles</h2>
    
    <?php if (empty($articleFiles)): ?>
        <p>No articles found in this category.</p>
        <p><a href="articles.php">Back to All Articles</a></p>
    <?php else: ?>
        <p><a href="articles.php">Back to All Articles</a></p>
        
        <ul class="article-list">
            <?php 
            foreach ($paginatedArticles as $file) {
                $title = "Untitled Article";
                $slug = basename($file, ".md");
                $summary = "";
                $date = "";
                
                $handle = fopen($file, "r");
                if ($handle) {
                    $inFrontMatter = false;
                    $frontMatterLines = 0;
                    while (($line = fgets($handle)) !== false) {
                        $trimmedLine = trim($line);
                        if ($trimmedLine === "---") {
                            if ($frontMatterLines === 0) {
                                $inFrontMatter = true;
                            } else {
                                break; // End of front matter
                            }
                            $frontMatterLines++;
                        } elseif ($inFrontMatter) {
                            if (strpos($trimmedLine, "title:") === 0) {
                                $title = trim(substr($trimmedLine, 6));
                            }
                            if (strpos($trimmedLine, "slug:") === 0) {
                                $slug = trim(substr($trimmedLine, 5));
                            }
                            if (strpos($trimmedLine, "summary:") === 0) {
                                $summary = trim(substr($trimmedLine, 8));
                            }
                            if (strpos($trimmedLine, "date:") === 0) {
                                $date = trim(substr($trimmedLine, 5));
                            }
                        }
                    }
                    fclose($handle);
                }
                
                echo "<li class='article-item'>";
                echo "<h3><a href=\"article.php?slug=" . htmlspecialchars($slug) . "\">" . htmlspecialchars($title) . "</a></h3>";
                if (!empty($date)) {
                    echo "<div class='article-date'>" . htmlspecialchars($date) . "</div>";
                }
                if (!empty($summary)) {
                    echo "<p class='article-summary'>" . htmlspecialchars($summary) . "</p>";
                }
                echo "<a href=\"article.php?slug=" . htmlspecialchars($slug) . "\" class='read-more'>Read More</a>";
                echo "</li>";
            }
            ?>
        </ul>
        
        <?php if ($totalPages > 1): ?>
        <div class="pagination">
            <?php if ($currentPage > 1): ?>
                <a href="?category=<?php echo htmlspecialchars($category); ?>&page=<?php echo $currentPage - 1; ?>" class="pagination-link">&laquo; Previous</a>
            <?php endif; ?>
            
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <?php if ($i == $currentPage): ?>
                    <span class="pagination-link current"><?php echo $i; ?></span>
                <?php else: ?>
                    <a href="?category=<?php echo htmlspecialchars($category); ?>&page=<?php echo $i; ?>" class="pagination-link"><?php echo $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>
            
            <?php if ($currentPage < $totalPages): ?>
                <a href="?category=<?php echo htmlspecialchars($category); ?>&page=<?php echo $currentPage + 1; ?>" class="pagination-link">Next &raquo;</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php include("footer.php"); ?>

<?php
require_once 'vendor/autoload.php';

$pageTitle = "Tag Not Found - Jax Sod Inc.";
$tagName = "Tag Not Found";
$articleFiles = [];
$matchingArticles = [];

if (isset($_GET['tag'])) {
    // Sanitize the tag name
    $tag = preg_replace('/[^a-zA-Z0-9-]/', '', $_GET['tag']);
    
    // Format tag name for display
    $tagName = ucwords(str_replace('-', ' ', $tag));
    
    // Set page title
    $pageTitle = "Articles Tagged: " . $tagName . " - Jax Sod Inc.";
    
    // Search for articles with this tag in all category directories
    $categoryDirs = glob("content/articles/*", GLOB_ONLYDIR);
    
    foreach ($categoryDirs as $categoryDir) {
        $files = glob($categoryDir . "/*.md");
        foreach ($files as $file) {
            $content = file_get_contents($file);
            
            // Check if the file has front matter with the specified tag
            if (preg_match('/^---\s*\n(.*?)\n---\s*\n/s', $content, $matches)) {
                $frontMatter = $matches[1];
                
                // Look for tags in the front matter
                if (preg_match('/^tags:\s*\[(.*)\]/m', $frontMatter, $tagsMatch)) {
                    $tagsString = trim($tagsMatch[1]);
                    $fileTags = array_map('trim', explode(',', $tagsString));
                    
                    // Check if the requested tag is in this file's tags
                    foreach ($fileTags as $fileTag) {
                        if (strtolower($fileTag) === strtolower($tag)) {
                            $matchingArticles[] = $file;
                            break;
                        }
                    }
                }
            }
        }
    }
    
    // Also check the root articles directory for backward compatibility
    $rootFiles = glob("content/articles/*.md");
    foreach ($rootFiles as $file) {
        $content = file_get_contents($file);
        
        // Check if the file has front matter with the specified tag
        if (preg_match('/^---\s*\n(.*?)\n---\s*\n/s', $content, $matches)) {
            $frontMatter = $matches[1];
            
            // Look for tags in the front matter
            if (preg_match('/^tags:\s*\[(.*)\]/m', $frontMatter, $tagsMatch)) {
                $tagsString = trim($tagsMatch[1]);
                $fileTags = array_map('trim', explode(',', $tagsString));
                
                // Check if the requested tag is in this file's tags
                foreach ($fileTags as $fileTag) {
                    if (strtolower($fileTag) === strtolower($tag)) {
                        $matchingArticles[] = $file;
                        break;
                    }
                }
            }
        }
    }
}

// Pagination settings
$articlesPerPage = 10;
$totalArticles = count($matchingArticles);
$totalPages = ceil($totalArticles / $articlesPerPage);
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($currentPage - 1) * $articlesPerPage;
$paginatedArticles = array_slice($matchingArticles, $offset, $articlesPerPage);

include("header.php");
?>

<div class="container page-content">
    <h2>Articles Tagged: <?php echo htmlspecialchars($tagName); ?></h2>
    
    <?php if (empty($matchingArticles)): ?>
        <p>No articles found with this tag.</p>
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
                $category = "";
                
                // Determine category from file path
                $pathParts = explode('/', $file);
                if (count($pathParts) > 2) {
                    $category = $pathParts[count($pathParts) - 2];
                }
                
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
                            if (strpos($trimmedLine, "category:") === 0) {
                                $category = trim(substr($trimmedLine, 9));
                            }
                        }
                    }
                    fclose($handle);
                }
                
                echo "<li class='article-item'>";
                echo "<h3><a href=\"article.php?slug=" . htmlspecialchars($slug) . "\">" . htmlspecialchars($title) . "</a></h3>";
                
                if (!empty($category)) {
                    echo "<div class='article-category'>Category: <a href=\"category.php?category=" . htmlspecialchars($category) . "\">" . htmlspecialchars(ucwords(str_replace('-', ' ', $category))) . "</a></div>";
                }
                
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
                <a href="?tag=<?php echo htmlspecialchars($tag); ?>&page=<?php echo $currentPage - 1; ?>" class="pagination-link">&laquo; Previous</a>
            <?php endif; ?>
            
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <?php if ($i == $currentPage): ?>
                    <span class="pagination-link current"><?php echo $i; ?></span>
                <?php else: ?>
                    <a href="?tag=<?php echo htmlspecialchars($tag); ?>&page=<?php echo $i; ?>" class="pagination-link"><?php echo $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>
            
            <?php if ($currentPage < $totalPages): ?>
                <a href="?tag=<?php echo htmlspecialchars($tag); ?>&page=<?php echo $currentPage + 1; ?>" class="pagination-link">Next &raquo;</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php include("footer.php"); ?>

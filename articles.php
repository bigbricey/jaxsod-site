<?php 
$pageTitle = "Landscaping Articles - Jax Sod Inc."; 
include("header.php"); 

// Get all category directories
$categoryDirs = glob("content/articles/*", GLOB_ONLYDIR);
$allArticles = [];
$categories = [];

// Collect articles from all category directories
foreach ($categoryDirs as $categoryDir) {
    $categoryName = basename($categoryDir);
    $categories[$categoryName] = ucwords(str_replace('-', ' ', $categoryName));
    
    $articleFiles = glob($categoryDir . "/*.md");
    foreach ($articleFiles as $file) {
        $allArticles[] = [
            'file' => $file,
            'category' => $categoryName
        ];
    }
}

// Also check root articles directory for backward compatibility
$rootArticles = glob("content/articles/*.md");
foreach ($rootArticles as $file) {
    $allArticles[] = [
        'file' => $file,
        'category' => ''
    ];
}

// Sort articles by date (newest first)
usort($allArticles, function($a, $b) {
    $dateA = '';
    $dateB = '';
    
    // Get date from file A
    $contentA = file_get_contents($a['file']);
    if (preg_match('/^---\s*\n(.*?)\n---\s*\n/s', $contentA, $matches)) {
        $frontMatter = $matches[1];
        if (preg_match('/^date:\s*(.*)/m', $frontMatter, $dateMatch)) {
            $dateA = trim($dateMatch[1]);
        }
    }
    
    // Get date from file B
    $contentB = file_get_contents($b['file']);
    if (preg_match('/^---\s*\n(.*?)\n---\s*\n/s', $contentB, $matches)) {
        $frontMatter = $matches[1];
        if (preg_match('/^date:\s*(.*)/m', $frontMatter, $dateMatch)) {
            $dateB = trim($dateMatch[1]);
        }
    }
    
    // Sort by date (newest first)
    return strcmp($dateB, $dateA);
});

// Pagination settings
$articlesPerPage = 10;
$totalArticles = count($allArticles);
$totalPages = ceil($totalArticles / $articlesPerPage);
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($currentPage - 1) * $articlesPerPage;
$paginatedArticles = array_slice($allArticles, $offset, $articlesPerPage);

// Collect all tags for tag cloud
$allTags = [];
foreach ($allArticles as $article) {
    $content = file_get_contents($article['file']);
    if (preg_match('/^---\s*\n(.*?)\n---\s*\n/s', $content, $matches)) {
        $frontMatter = $matches[1];
        if (preg_match('/^tags:\s*\[(.*)\]/m', $frontMatter, $tagsMatch)) {
            $tagsString = trim($tagsMatch[1]);
            $articleTags = array_map('trim', explode(',', $tagsString));
            foreach ($articleTags as $tag) {
                if (!empty($tag)) {
                    if (isset($allTags[$tag])) {
                        $allTags[$tag]++;
                    } else {
                        $allTags[$tag] = 1;
                    }
                }
            }
        }
    }
}
// Sort tags alphabetically
ksort($allTags);

?>
<div class="container page-content">
    <h2>Landscaping Articles</h2>
    
    <div class="row">
        <div class="col-md-8">
            <?php if (empty($allArticles)): ?>
                <p>No articles found yet.</p>
            <?php else: ?>
                <ul class="article-list">
                    <?php 
                    foreach ($paginatedArticles as $article) {
                        $file = $article['file'];
                        $category = $article['category'];
                        
                        $title = "Untitled Article";
                        $slug = basename($file, ".md");
                        $summary = "";
                        $date = "";
                        $tags = [];

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
                                    if (strpos($trimmedLine, "tags:") === 0 && preg_match('/\[(.*)\]/', $trimmedLine, $matches)) {
                                        $tagsString = $matches[1];
                                        $tags = array_map('trim', explode(',', $tagsString));
                                    }
                                }
                            }
                            fclose($handle);
                        }
                        
                        echo "<li class='article-item'>";
                        echo "<h3><a href=\"article.php?slug=" . htmlspecialchars($slug) . "\">" . htmlspecialchars($title) . "</a></h3>";
                        
                        echo "<div class='article-meta'>";
                        if (!empty($date)) {
                            echo "<span class='article-date'>" . htmlspecialchars($date) . "</span>";
                        }
                        
                        if (!empty($category)) {
                            echo "<span class='article-category'>Category: <a href=\"category.php?category=" . htmlspecialchars($category) . "\">" . htmlspecialchars(ucwords(str_replace('-', ' ', $category))) . "</a></span>";
                        }
                        echo "</div>";
                        
                        if (!empty($summary)) {
                            echo "<p class='article-summary'>" . htmlspecialchars($summary) . "</p>";
                        }
                        
                        if (!empty($tags)) {
                            echo "<div class='article-tags'>Tags: ";
                            foreach ($tags as $index => $tag) {
                                echo "<a href=\"tag.php?tag=" . htmlspecialchars(trim($tag)) . "\" class='tag'>" . htmlspecialchars(trim($tag)) . "</a>";
                                if ($index < count($tags) - 1) {
                                    echo ", ";
                                }
                            }
                            echo "</div>";
                        }
                        
                        echo "<a href=\"article.php?slug=" . htmlspecialchars($slug) . "\" class='read-more'>Read More</a>";
                        echo "</li>";
                    }
                    ?>
                </ul>
                
                <?php if ($totalPages > 1): ?>
                <div class="pagination">
                    <?php if ($currentPage > 1): ?>
                        <a href="?page=<?php echo $currentPage - 1; ?>" class="pagination-link">&laquo; Previous</a>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <?php if ($i == $currentPage): ?>
                            <span class="pagination-link current"><?php echo $i; ?></span>
                        <?php else: ?>
                            <a href="?page=<?php echo $i; ?>" class="pagination-link"><?php echo $i; ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>
                    
                    <?php if ($currentPage < $totalPages): ?>
                        <a href="?page=<?php echo $currentPage + 1; ?>" class="pagination-link">Next &raquo;</a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        
        <div class="col-md-4">
            <div class="sidebar">
                <div class="sidebar-section">
                    <h3>Categories</h3>
                    <ul class="category-list">
                        <?php foreach ($categories as $slug => $name): ?>
                            <li><a href="category.php?category=<?php echo htmlspecialchars($slug); ?>"><?php echo htmlspecialchars($name); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <?php if (!empty($allTags)): ?>
                <div class="sidebar-section">
                    <h3>Popular Tags</h3>
                    <div class="tag-cloud">
                        <?php foreach ($allTags as $tag => $count): ?>
                            <a href="tag.php?tag=<?php echo htmlspecialchars($tag); ?>" class="tag" style="font-size: <?php echo min(1.5, 0.8 + ($count / 5)); ?>em;"><?php echo htmlspecialchars($tag); ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>

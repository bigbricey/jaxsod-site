<?php
require_once 'vendor/autoload.php'; // Include Composer's autoloader

$pageTitle = "Article Not Found"; // Default title
$articleContentHtml = "<p>The requested article could not be found.</p>";
$articleTitle = "Article"; // Default article H1 title
$articleCategory = "";
$articleTags = [];
$articleDate = "";
$articleAuthor = "";
$relatedArticles = [];

if (isset($_GET['slug'])) {
    // Sanitize the slug: allow only alphanumeric characters and hyphens
    $slug = preg_replace('/[^a-zA-Z0-9-]/', '', $_GET['slug']);
    
    // Search for the article in all category directories
    $articleFound = false;
    $articlePath = "";
    $categoryDirs = glob("content/articles/*", GLOB_ONLYDIR);
    
    foreach ($categoryDirs as $categoryDir) {
        $filePath = $categoryDir . "/" . $slug . ".md";
        if (file_exists($filePath)) {
            $articleFound = true;
            $articlePath = $filePath;
            $articleCategory = basename($categoryDir);
            break;
        }
    }
    
    // Also check the root articles directory for backward compatibility
    if (!$articleFound) {
        $rootFilePath = "content/articles/" . $slug . ".md";
        if (file_exists($rootFilePath)) {
            $articleFound = true;
            $articlePath = $rootFilePath;
        }
    }
    
    if ($articleFound) {
        $fullContent = file_get_contents($articlePath);
        $Parsedown = new Parsedown();
        
        $articleTitle = ucwords(str_replace('-', ' ', $slug)); // Default title from slug
        $markdownBody = $fullContent;

        // Enhanced front matter parsing
        if (preg_match('/^---\s*\n(.*?)\n---\s*\n(.*)/s', $fullContent, $matches)) {
            $frontMatterRaw = $matches[1];
            $markdownBody = $matches[2];
            
            // Extract metadata from front matter
            if (preg_match('/^title:\s*(.*)/m', $frontMatterRaw, $titleMatch)) {
                $articleTitle = trim($titleMatch[1]);
            }
            
            if (preg_match('/^category:\s*(.*)/m', $frontMatterRaw, $categoryMatch)) {
                $articleCategory = trim($categoryMatch[1]);
            }
            
            if (preg_match('/^date:\s*(.*)/m', $frontMatterRaw, $dateMatch)) {
                $articleDate = trim($dateMatch[1]);
            }
            
            if (preg_match('/^author:\s*(.*)/m', $frontMatterRaw, $authorMatch)) {
                $articleAuthor = trim($authorMatch[1]);
            }
            
            if (preg_match('/^tags:\s*\[(.*)\]/m', $frontMatterRaw, $tagsMatch)) {
                $tagsString = trim($tagsMatch[1]);
                $articleTags = array_map('trim', explode(',', $tagsString));
            }
        }
        
        $pageTitle = htmlspecialchars($articleTitle) . " - Jax Sod Inc.";
        $articleContentHtml = $Parsedown->text($markdownBody);
        
        // Find related articles based on category
        if (!empty($articleCategory)) {
            $categoryPath = "content/articles/" . $articleCategory;
            if (is_dir($categoryPath)) {
                $relatedFiles = glob($categoryPath . "/*.md");
                // Remove current article from related articles
                $relatedFiles = array_filter($relatedFiles, function($file) use ($slug) {
                    return basename($file, ".md") !== $slug;
                });
                // Limit to 3 related articles
                $relatedFiles = array_slice($relatedFiles, 0, 3);
                
                foreach ($relatedFiles as $file) {
                    $relatedTitle = basename($file, ".md");
                    $relatedSlug = $relatedTitle;
                    
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
                                    $relatedTitle = trim(substr($trimmedLine, 6));
                                }
                                if (strpos($trimmedLine, "slug:") === 0) {
                                    $relatedSlug = trim(substr($trimmedLine, 5));
                                }
                            }
                        }
                        fclose($handle);
                    }
                    
                    $relatedArticles[] = [
                        'title' => $relatedTitle,
                        'slug' => $relatedSlug
                    ];
                }
            }
        }
    } else {
        // Article not found
        $articleContentHtml = "<p>The article specified by the slug '" . htmlspecialchars($_GET['slug']) . "' could not be found.</p>";
    }
} else {
    $articleContentHtml = "<p>No article specified.</p>";
}

include("header.php"); 
?>
<div class="container page-content">
    <article class="article-content">
        <h1><?php echo htmlspecialchars($articleTitle); ?></h1>
        
        <div class="article-meta">
            <?php if (!empty($articleDate)): ?>
                <span class="article-date">Published: <?php echo htmlspecialchars($articleDate); ?></span>
            <?php endif; ?>
            
            <?php if (!empty($articleAuthor)): ?>
                <span class="article-author">By: <?php echo htmlspecialchars($articleAuthor); ?></span>
            <?php endif; ?>
            
            <?php if (!empty($articleCategory)): ?>
                <span class="article-category">Category: <a href="category.php?category=<?php echo htmlspecialchars($articleCategory); ?>"><?php echo htmlspecialchars(ucwords(str_replace('-', ' ', $articleCategory))); ?></a></span>
            <?php endif; ?>
        </div>
        
        <?php if (!empty($articleTags)): ?>
        <div class="article-tags">
            Tags: 
            <?php foreach ($articleTags as $index => $tag): ?>
                <a href="tag.php?tag=<?php echo htmlspecialchars(trim($tag)); ?>" class="tag"><?php echo htmlspecialchars(trim($tag)); ?></a><?php echo ($index < count($articleTags) - 1) ? ', ' : ''; ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        
        <div class="article-content-body">
            <?php echo $articleContentHtml; ?>
        </div>
        
        <?php if (!empty($relatedArticles)): ?>
        <div class="related-articles">
            <h3>Related Articles</h3>
            <ul>
                <?php foreach ($relatedArticles as $related): ?>
                    <li><a href="article.php?slug=<?php echo htmlspecialchars($related['slug']); ?>"><?php echo htmlspecialchars($related['title']); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>
        
        <div class="article-navigation">
            <a href="articles.php" class="btn btn-outline-primary">Back to All Articles</a>
            <?php if (!empty($articleCategory)): ?>
                <a href="category.php?category=<?php echo htmlspecialchars($articleCategory); ?>" class="btn btn-outline-primary">More <?php echo htmlspecialchars(ucwords(str_replace('-', ' ', $articleCategory))); ?> Articles</a>
            <?php endif; ?>
        </div>
    </article>
</div>
<?php include("footer.php"); ?>

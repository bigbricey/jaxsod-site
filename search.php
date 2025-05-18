<?php 
$searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';
$pageTitle = "Search Results" . ($searchQuery ? " for '" . htmlspecialchars($searchQuery) . "'" : "") . " - Jax Sod Inc."; 
include("header.php"); 

$articlesDir = "content/articles/";
$results = [];

?>
<div class="container page-content">
    <h2>Search Results</h2>

    <?php if (empty($searchQuery)): ?>
        <p>Please enter a search term in the box above.</p>
    <?php else: ?>
        <p>Showing results for: <strong><?php echo htmlspecialchars($searchQuery); ?></strong></p>
        <?php
        $articleFiles = glob($articlesDir . "*.md");
        if (!empty($articleFiles)) {
            foreach ($articleFiles as $file) {
                $content = file_get_contents($file);
                // Case-insensitive search
                if (stripos($content, $searchQuery) !== false) {
                    // Found a match, extract info (similar to articles.php)
                    $title = "Untitled Article";
                    $slug = basename($file, ".md");
                    $summary = "";

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
                            }
                        }
                        fclose($handle);
                    }
                    
                    // Use filename as slug if not found
                    if (empty($slug)) {
                         $slug = basename($file, ".md");
                    }
                    
                    // Basic snippet generation if no summary
                    if (empty($summary)) {
                        // Remove front matter for snippet
                        $bodyContent = preg_replace('/^---\s*\n(.*?)\n---\s*\n/s', '', $content);
                        // Strip markdown characters for a cleaner snippet
                        $bodyContent = preg_replace('/[#*`~->]|(\[.*?\]\(.*?\))/s', '', $bodyContent);
                        $summary = substr(strip_tags(str_replace("\n", " ", $bodyContent)), 0, 200) . '...';
                    }

                    $results[] = [
                        'title' => $title,
                        'slug' => $slug,
                        'summary' => $summary
                    ];
                }
            }
        }
        ?>

        <?php if (empty($results)): ?>
            <p>No articles found matching your search term.</p>
        <?php else: ?>
            <ul class="article-list search-results">
                <?php foreach ($results as $result): ?>
                    <li>
                        <h3><a href="article.php?slug=<?php echo htmlspecialchars($result['slug']); ?>"><?php echo htmlspecialchars($result['title']); ?></a></h3>
                        <p><?php echo htmlspecialchars($result['summary']); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?php include("footer.php"); ?>

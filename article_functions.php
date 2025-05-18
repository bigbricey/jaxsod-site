<?php
// Get all category directories
$categoryDirs = glob("content/articles/*", GLOB_ONLYDIR);
$categories = [];

// Collect category information
foreach ($categoryDirs as $categoryDir) {
    $categoryName = basename($categoryDir);
    $displayName = ucwords(str_replace('-', ' ', $categoryName));
    $articleCount = count(glob($categoryDir . "/*.md"));
    
    $categories[$categoryName] = [
        'name' => $displayName,
        'count' => $articleCount
    ];
}

// Sort categories alphabetically by display name
uasort($categories, function($a, $b) {
    return strcmp($a['name'], $b['name']);
});

// Get all tags from all articles
$allTags = [];
$allArticles = [];

// Process articles in category directories
foreach ($categoryDirs as $categoryDir) {
    $categoryName = basename($categoryDir);
    $articleFiles = glob($categoryDir . "/*.md");
    
    foreach ($articleFiles as $file) {
        $content = file_get_contents($file);
        $slug = basename($file, ".md");
        $title = "Untitled Article";
        $date = "";
        $summary = "";
        $tags = [];
        
        // Extract front matter
        if (preg_match('/^---\s*\n(.*?)\n---\s*\n/s', $content, $matches)) {
            $frontMatter = $matches[1];
            
            // Get title
            if (preg_match('/^title:\s*(.*)/m', $frontMatter, $titleMatch)) {
                $title = trim($titleMatch[1]);
            }
            
            // Get slug
            if (preg_match('/^slug:\s*(.*)/m', $frontMatter, $slugMatch)) {
                $slug = trim($slugMatch[1]);
            }
            
            // Get date
            if (preg_match('/^date:\s*(.*)/m', $frontMatter, $dateMatch)) {
                $date = trim($dateMatch[1]);
            }
            
            // Get summary
            if (preg_match('/^summary:\s*(.*)/m', $frontMatter, $summaryMatch)) {
                $summary = trim($summaryMatch[1]);
            }
            
            // Get tags
            if (preg_match('/^tags:\s*\[(.*)\]/m', $frontMatter, $tagsMatch)) {
                $tagsString = trim($tagsMatch[1]);
                $tags = array_map('trim', explode(',', $tagsString));
                
                // Add to tag collection
                foreach ($tags as $tag) {
                    $tag = trim($tag);
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
        
        // Add to articles collection
        $allArticles[] = [
            'title' => $title,
            'slug' => $slug,
            'date' => $date,
            'summary' => $summary,
            'category' => $categoryName,
            'tags' => $tags,
            'file' => $file
        ];
    }
}

// Also check root articles directory for backward compatibility
$rootArticles = glob("content/articles/*.md");
foreach ($rootArticles as $file) {
    $content = file_get_contents($file);
    $slug = basename($file, ".md");
    $title = "Untitled Article";
    $date = "";
    $summary = "";
    $tags = [];
    $category = "";
    
    // Extract front matter
    if (preg_match('/^---\s*\n(.*?)\n---\s*\n/s', $content, $matches)) {
        $frontMatter = $matches[1];
        
        // Get title
        if (preg_match('/^title:\s*(.*)/m', $frontMatter, $titleMatch)) {
            $title = trim($titleMatch[1]);
        }
        
        // Get slug
        if (preg_match('/^slug:\s*(.*)/m', $frontMatter, $slugMatch)) {
            $slug = trim($slugMatch[1]);
        }
        
        // Get date
        if (preg_match('/^date:\s*(.*)/m', $frontMatter, $dateMatch)) {
            $date = trim($dateMatch[1]);
        }
        
        // Get summary
        if (preg_match('/^summary:\s*(.*)/m', $frontMatter, $summaryMatch)) {
            $summary = trim($summaryMatch[1]);
        }
        
        // Get category
        if (preg_match('/^category:\s*(.*)/m', $frontMatter, $categoryMatch)) {
            $category = trim($categoryMatch[1]);
        }
        
        // Get tags
        if (preg_match('/^tags:\s*\[(.*)\]/m', $frontMatter, $tagsMatch)) {
            $tagsString = trim($tagsMatch[1]);
            $tags = array_map('trim', explode(',', $tagsString));
            
            // Add to tag collection
            foreach ($tags as $tag) {
                $tag = trim($tag);
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
    
    // Add to articles collection
    $allArticles[] = [
        'title' => $title,
        'slug' => $slug,
        'date' => $date,
        'summary' => $summary,
        'category' => $category,
        'tags' => $tags,
        'file' => $file
    ];
}

// Sort tags alphabetically
ksort($allTags);

// Sort articles by date (newest first)
usort($allArticles, function($a, $b) {
    return strcmp($b['date'], $a['date']);
});

// Get recent articles (5 most recent)
$recentArticles = array_slice($allArticles, 0, 5);

// Get popular tags (top 10 by usage)
arsort($allTags);
$popularTags = array_slice($allTags, 0, 10, true);

// Function to get related articles based on category and tags
function getRelatedArticles($currentSlug, $currentCategory, $currentTags, $allArticles, $limit = 3) {
    $relatedArticles = [];
    $scoreMap = [];
    
    // Score all articles based on relevance
    foreach ($allArticles as $article) {
        // Skip the current article
        if ($article['slug'] === $currentSlug) {
            continue;
        }
        
        $score = 0;
        
        // Same category is a strong indicator of relevance
        if ($article['category'] === $currentCategory) {
            $score += 5;
        }
        
        // Shared tags increase relevance
        foreach ($article['tags'] as $tag) {
            if (in_array($tag, $currentTags)) {
                $score += 2;
            }
        }
        
        // Only include articles with some relevance
        if ($score > 0) {
            $scoreMap[$article['slug']] = [
                'article' => $article,
                'score' => $score
            ];
        }
    }
    
    // Sort by relevance score (highest first)
    uasort($scoreMap, function($a, $b) {
        return $b['score'] - $a['score'];
    });
    
    // Get top related articles
    $count = 0;
    foreach ($scoreMap as $item) {
        $relatedArticles[] = $item['article'];
        $count++;
        if ($count >= $limit) {
            break;
        }
    }
    
    return $relatedArticles;
}
?>

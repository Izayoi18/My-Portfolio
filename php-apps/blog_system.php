<?php
/**
 * Simple Blog System
 * A basic blog with posts management
 */

// Simple data storage (in a real app, use a database)
$posts_file = 'blog_posts.json';

// Initialize posts array
$posts = [];
if (file_exists($posts_file)) {
    $posts = json_decode(file_get_contents($posts_file), true) ?: [];
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'add' && !empty($_POST['title']) && !empty($_POST['content'])) {
            $new_post = [
                'id' => time(),
                'title' => htmlspecialchars($_POST['title']),
                'content' => htmlspecialchars($_POST['content']),
                'author' => htmlspecialchars($_POST['author'] ?: 'Anonymous'),
                'date' => date('Y-m-d H:i:s'),
                'views' => 0
            ];
            array_unshift($posts, $new_post);
            file_put_contents($posts_file, json_encode($posts));
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } elseif ($_POST['action'] == 'delete' && isset($_POST['id'])) {
            $posts = array_filter($posts, function($post) {
                return $post['id'] != $_POST['id'];
            });
            file_put_contents($posts_file, json_encode(array_values($posts)));
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    }
}

// Handle viewing a post
$viewing_post = null;
if (isset($_GET['view'])) {
    foreach ($posts as $key => $post) {
        if ($post['id'] == $_GET['view']) {
            $posts[$key]['views']++;
            $viewing_post = $posts[$key];
            file_put_contents($posts_file, json_encode($posts));
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Blog</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            line-height: 1.6;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 0;
            text-align: center;
            margin-bottom: 30px;
            border-radius: 10px;
        }
        
        h1 {
            font-size: 2.5em;
        }
        
        .add-post {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #333;
        }
        
        input, textarea {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        
        textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
        }
        
        button:hover {
            opacity: 0.9;
        }
        
        .post {
            background: white;
            padding: 25px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .post h2 {
            color: #333;
            margin-bottom: 10px;
        }
        
        .post-meta {
            color: #666;
            font-size: 0.9em;
            margin-bottom: 15px;
        }
        
        .post-content {
            color: #444;
            margin-bottom: 15px;
        }
        
        .post-actions {
            display: flex;
            gap: 10px;
        }
        
        .btn-view {
            background: #4CAF50;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }
        
        .btn-delete {
            background: #f44336;
            padding: 8px 15px;
            font-size: 14px;
        }
        
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        
        .single-post {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>📝 Simple Blog</h1>
        </header>
        
        <?php if ($viewing_post): ?>
            <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="back-link">← Back to all posts</a>
            
            <div class="single-post">
                <h2><?php echo $viewing_post['title']; ?></h2>
                <div class="post-meta">
                    By <?php echo $viewing_post['author']; ?> on <?php echo $viewing_post['date']; ?> | 
                    Views: <?php echo $viewing_post['views']; ?>
                </div>
                <div class="post-content">
                    <?php echo nl2br($viewing_post['content']); ?>
                </div>
            </div>
        <?php else: ?>
            <div class="add-post">
                <h2>Create New Post</h2>
                <form method="POST">
                    <input type="hidden" name="action" value="add">
                    
                    <div class="form-group">
                        <label for="title">Title *</label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" id="author" name="author" placeholder="Anonymous">
                    </div>
                    
                    <div class="form-group">
                        <label for="content">Content *</label>
                        <textarea id="content" name="content" required></textarea>
                    </div>
                    
                    <button type="submit">Publish Post</button>
                </form>
            </div>
            
            <h2 style="margin-bottom: 20px;">Recent Posts</h2>
            
            <?php if (empty($posts)): ?>
                <p>No posts yet. Create your first post above!</p>
            <?php else: ?>
                <?php foreach ($posts as $post): ?>
                    <div class="post">
                        <h2><?php echo $post['title']; ?></h2>
                        <div class="post-meta">
                            By <?php echo $post['author']; ?> on <?php echo $post['date']; ?> | 
                            Views: <?php echo $post['views']; ?>
                        </div>
                        <div class="post-content">
                            <?php echo substr(nl2br($post['content']), 0, 200) . '...'; ?>
                        </div>
                        <div class="post-actions">
                            <a href="?view=<?php echo $post['id']; ?>" class="btn-view">Read More</a>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                                <button type="submit" class="btn-delete" onclick="return confirm('Delete this post?')">Delete</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>

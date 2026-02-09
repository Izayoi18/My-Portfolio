# Quick Start Guide

This guide will help you quickly test all applications in this portfolio.

## Python Applications

### Test Todo List App
```bash
cd python-apps
python3 todo_app.py
# Then follow the interactive prompts:
# 1 - Add a task
# 2 - List all tasks
# 3 - Complete a task
# 4 - Delete a task
# 5 - Exit
```

### Test Weather App
```bash
cd python-apps
python3 weather_app.py
# Then follow the prompts:
# 1 - Check weather (try: Tokyo, London, New York, Paris, Sydney)
# 2 - List available cities
# 3 - Exit
```

### Test Calculator App
```bash
cd python-apps
python3 calculator_app.py
# Try different operations:
# 1 - Add
# 2 - Subtract
# 3 - Multiply
# 4 - Divide
# 5 - Power
# 6 - Square Root
# 7 - Percentage
# 8 - Exit
```

## PHP Applications

### Test Contact Form
```bash
cd php-apps
php -S localhost:8000 contact_form.php
# Then open your browser to: http://localhost:8000
# Fill out the form and submit
```

### Test Blog System
```bash
cd php-apps
php -S localhost:8001 blog_system.php
# Then open your browser to: http://localhost:8001
# Create posts, view them, and test the blog features
```

## HTML/CSS/JavaScript Websites

### View Landing Page
```bash
cd websites/landing-page
# Open index.html in your browser
# Try scrolling to see animations
# Click on navigation links
```

### View Calculator Website
```bash
cd websites/calculator
# Open index.html in your browser
# Try clicking buttons or using keyboard:
#   - Numbers: 0-9
#   - Operations: +, -, *, /
#   - Enter/= : Calculate
#   - Escape: Clear
#   - Backspace: Delete
```

### View Image Gallery
```bash
cd websites/image-gallery
# Open index.html in your browser
# Try filtering by category
# Click images to view in lightbox
# Press ESC to close lightbox
```

## Testing with Python HTTP Server

For the HTML websites, you can also use Python's HTTP server:

```bash
cd websites/landing-page
python3 -m http.server 8080
# Visit: http://localhost:8080
```

## What to Look For

### Python Apps
- ✓ Interactive command-line interface
- ✓ Proper error handling
- ✓ Data persistence (for todo app)
- ✓ Clear output formatting

### PHP Apps
- ✓ Form validation
- ✓ Error messages display
- ✓ Data storage in files
- ✓ Responsive design

### Websites
- ✓ Smooth animations
- ✓ Responsive layouts
- ✓ Interactive elements
- ✓ Keyboard support (calculator)
- ✓ Visual feedback on hover

## Troubleshooting

### Python apps not working?
- Ensure Python 3.6+ is installed: `python3 --version`
- Make files executable: `chmod +x *.py`

### PHP apps not working?
- Ensure PHP 7.0+ is installed: `php --version`
- Check port is not in use
- Try a different port: `php -S localhost:9000 file.php`

### Websites not displaying correctly?
- Use a modern browser (Chrome, Firefox, Safari, Edge)
- Check JavaScript is enabled
- Try opening in private/incognito mode

## Tips

1. **Python apps**: Use Ctrl+C to exit if needed
2. **PHP apps**: Use Ctrl+C to stop the server
3. **Websites**: Open browser developer tools (F12) to see console logs
4. **File locations**: Data files are created in the same directory as the app

Enjoy exploring the portfolio! 🚀

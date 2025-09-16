# Crime Data Analysis System

![License](https://img.shields.io/badge/license-MIT-blue.svg)
![PHP](https://img.shields.io/badge/PHP-7.4%2B-blue.svg)
![MySQL](https://img.shields.io/badge/MySQL-5.7%2B-blue.svg)

A comprehensive web-based crime data analysis system built with PHP and MySQL. This application provides tools for analyzing, visualizing, and managing crime statistics with an intuitive web interface.

## 🚀 Features

- **Data Management**: Import, export, and manage crime data records
- **Statistical Analysis**: Generate comprehensive crime statistics and trends
- **Data Visualization**: Interactive charts and graphs for crime data insights
- **Search & Filter**: Advanced search capabilities with multiple filter options
- **Report Generation**: Generate detailed reports in various formats
- **User Management**: Role-based access control for administrators and analysts
- **Dashboard**: Real-time crime statistics overview
- **Geolocation Support**: Map-based crime data visualization
- **Responsive Design**: Mobile-friendly interface

## 🛠️ Technology Stack

- **Backend**: PHP 7.4+
- **Database**: MySQL 5.7+
- **Frontend**: HTML5, CSS3, JavaScript (ES6+)
- **Libraries**: 
  - Chart.js for data visualization
  - Bootstrap for responsive UI
  - jQuery for DOM manipulation
- **Web Server**: Apache/Nginx

## 📋 Prerequisites

Before you begin, ensure you have the following installed:

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- Composer (for dependency management)
- Git

### System Requirements

- **Minimum RAM**: 2GB
- **Storage**: 1GB free space
- **PHP Extensions**: mysqli, pdo, json, mbstring, openssl

## 🔧 Installation & Setup

### 1. Clone the Repository

```bash
git clone https://github.com/ibmrafi69/Crime-Data-Analysis.git
cd Crime-Data-Analysis
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Database Setup

#### Create Database

```sql
CREATE DATABASE crime_analysis;
USE crime_analysis;
```

#### Import Database Schema

```bash
mysql -u username -p crime_analysis < database/schema.sql
```

#### Import Sample Data (Optional)

```bash
mysql -u username -p crime_analysis < database/sample_data.sql
```

### 4. Configuration

1. Copy the configuration template:
```bash
cp config/config.example.php config/config.php
```

2. Update database configuration in `config/config.php`:

```php
<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
define('DB_NAME', 'crime_analysis');
define('APP_URL', 'http://localhost/crime-data-analysis');
define('APP_ENV', 'development'); // development or production
?>
```

### 5. Web Server Configuration

#### Apache

Create `.htaccess` file in the root directory:

```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]
```

#### Nginx

Add to your Nginx configuration:

```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}

location ~ \.php$ {
    fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
    fastcgi_index index.php;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    include fastcgi_params;
}
```

### 6. Set Permissions

```bash
chmod -R 755 .
chmod -R 777 uploads/
chmod -R 777 logs/
```

## 🗄️ Database Schema

### Core Tables

- `crimes` - Main crime records table
- `crime_types` - Crime category definitions
- `locations` - Geographic location data
- `users` - User accounts and authentication
- `reports` - Generated report metadata
- `settings` - Application configuration

### Key Relationships

```sql
crimes (crime_type_id) → crime_types (id)
crimes (location_id) → locations (id)
reports (user_id) → users (id)
```

## 🚀 Usage

### 1. Access the Application

Open your web browser and navigate to:
```
http://localhost/crime-data-analysis
```

### 2. Default Login

- **Username**: admin
- **Password**: admin123

⚠️ **Important**: Change the default password after first login!

### 3. Core Functions

#### Data Import
1. Navigate to "Data Management" → "Import Data"
2. Upload CSV file with crime data
3. Map columns to database fields
4. Review and confirm import

#### Generate Reports
1. Go to "Reports" → "Generate Report"
2. Select date range and filters
3. Choose report type (PDF, Excel, CSV)
4. Download generated report

#### View Analytics
1. Access "Dashboard" for overview
2. Use "Analytics" for detailed charts
3. Apply filters for specific insights

## 📁 Project Structure

```
Crime-Data-Analysis/
├── config/                 # Configuration files
│   ├── config.php          # Main configuration
│   └── database.php        # Database connection
├── src/                    # Source code
│   ├── controllers/        # PHP controllers
│   ├── models/            # Data models
│   ├── views/             # HTML templates
│   └── helpers/           # Utility functions
├── public/                # Public assets
│   ├── css/               # Stylesheets
│   ├── js/                # JavaScript files
│   └── images/            # Static images
├── database/              # Database files
│   ├── schema.sql         # Database schema
│   └── migrations/        # Database migrations
├── uploads/               # File uploads directory
├── logs/                  # Application logs
├── tests/                 # Unit tests
└── docs/                  # Documentation
```

## 🔌 API Documentation

### Base URL
```
http://localhost/crime-data-analysis/api/
```

### Authentication
Include API key in headers:
```
X-API-Key: your_api_key_here
```

### Endpoints

#### Get Crime Data
```http
GET /api/crimes
GET /api/crimes/{id}
```

#### Crime Statistics
```http
GET /api/statistics?from=YYYY-MM-DD&to=YYYY-MM-DD
```

#### Location Data
```http
GET /api/locations
GET /api/locations/{id}/crimes
```

For detailed API documentation, visit `/docs/api.html`

## 🧪 Testing

### Run Unit Tests

```bash
./vendor/bin/phpunit tests/
```

### Run Specific Test Suite

```bash
./vendor/bin/phpunit tests/Unit/CrimeModelTest.php
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Development Guidelines

- Follow PSR-12 coding standards
- Write unit tests for new features
- Update documentation for any API changes
- Use meaningful commit messages

## 🐛 Troubleshooting

### Common Issues

#### Database Connection Error
```
Error: Could not connect to database
```
**Solution**: Check database credentials in `config/config.php`

#### Permission Denied
```
Warning: file_put_contents(): failed to open stream
```
**Solution**: Set proper permissions for upload and log directories

#### PHP Version Error
```
Fatal error: syntax error, unexpected ':'
```
**Solution**: Ensure PHP 7.4+ is installed

### Debug Mode

Enable debug mode in `config/config.php`:
```php
define('DEBUG_MODE', true);
```

### Logs

Check application logs in `/logs/` directory:
- `error.log` - PHP errors
- `access.log` - User actions
- `debug.log` - Debug information

## 📖 Documentation

- [Installation Guide](docs/installation.md)
- [User Manual](docs/user-guide.md)
- [API Reference](docs/api.md)
- [Developer Guide](docs/development.md)

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- Crime data visualization techniques
- Open source PHP community
- Bootstrap and Chart.js communities

## 📞 Support

For support and questions:

- **Email**: support@crimedataanalysis.com
- **Issues**: [GitHub Issues](https://github.com/ibmrafi69/Crime-Data-Analysis/issues)
- **Discussions**: [GitHub Discussions](https://github.com/ibmrafi69/Crime-Data-Analysis/discussions)

## 🔄 Changelog

### v1.0.0 (TBD)
- Initial release
- Basic crime data management
- Statistical analysis features
- Report generation

---

⭐ **Star this repository if you find it helpful!**

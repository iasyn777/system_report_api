//создание таблицы в базе данных
CREATE TABLE system_reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    session_id VARCHAR(255) NOT NULL,
    user_agent TEXT,
    referrer TEXT,
    ip_address VARCHAR(45),
    device_type VARCHAR(50),
    page VARCHAR(255),
    page_url TEXT,
    visit_count INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

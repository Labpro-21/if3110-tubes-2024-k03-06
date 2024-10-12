-- User
CREATE TABLE _user (
    user_id SERIAL PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) CHECK (role IN ('jobseeker', 'company')),
    nama VARCHAR(255) NOT NULL
);

-- Company Detail
CREATE TABLE _company_detail (
    user_id INT REFERENCES _user(user_id),
    lokasi VARCHAR(255) NOT NULL,
    about TEXT
);

-- Lowongan
CREATE TABLE _lowongan (
    lowongan_id SERIAL PRIMARY KEY,
    company_id INT REFERENCES _user(user_id),
    posisi VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    jenis_pekerjaan VARCHAR(50),
    jenis_lokasi VARCHAR(50),
    is_open BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Attachment Lowongan
CREATE TABLE _attachment_lowongan (
    attachment_id SERIAL PRIMARY KEY,
    lowongan_id INT REFERENCES _lowongan(lowongan_id),  
    file_path VARCHAR(255) NOT NULL
);

-- Lamaran
CREATE TABLE _lamaran (
    lamaran_id SERIAL PRIMARY KEY,
    user_id INT REFERENCES _user(user_id),  
    lowongan_id INT REFERENCES _lowongan(lowongan_id), 
    cv_path VARCHAR(255),
    video_path VARCHAR(255),
    status VARCHAR(50) CHECK (status IN ('accepted', 'rejected', 'waiting')),
    status_reason TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

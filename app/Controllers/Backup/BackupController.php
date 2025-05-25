<?php

namespace App\Controllers\Backup;

use App\Controllers\BaseController;

class BackupController extends BaseController
{
    protected $db;
    protected $backupPath;
    
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->backupPath = WRITEPATH . 'uploads/backups/';
        
        // Create backup directory if not exists
        if (!is_dir($this->backupPath)) {
            mkdir($this->backupPath, 0755, true);
        }
    }
    
    public function index()
    {
        return view('Admin/backup/v_backup');
    }
    
    /**
     * Get list of tables
     */
    public function getTables()
    {
        try {
            $tables = $this->db->listTables();
            $result = [];
            
            foreach ($tables as $table) {
                $query = $this->db->query("SELECT COUNT(*) as count FROM `{$table}`");
                $count = $query->getRow()->count;
                
                $result[] = [
                    'table' => $table,
                    'rows' => $count
                ];
            }
            
            return $this->response->setJSON([
                'status' => 'success',
                'data' => $result
            ]);
            
        } catch (\Exception $e) {
            log_message('error', 'Get Tables Error: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal mengambil daftar tabel: ' . $e->getMessage()
            ]);
        }
    }
    
    /**
     * Get database configuration
     */
    private function getDatabaseConfig()
    {
        // Method 1: Using environment variables (recommended)
        return [
            'hostname' => env('database.default.hostname', 'localhost'),
            'username' => env('database.default.username', 'root'),
            'password' => env('database.default.password', ''),
            'database' => env('database.default.database', ''),
            'port' => env('database.default.port', 3306)
        ];
    }
    
    /**
     * Alternative method to get database config
     */
    private function getDatabaseConfigAlternative()
    {
        // Method 2: Direct from config file
        $config = new \Config\Database();
        $dbConfig = $config->default;
        
        return [
            'hostname' => $dbConfig['hostname'],
            'username' => $dbConfig['username'], 
            'password' => $dbConfig['password'],
            'database' => $dbConfig['database'],
            'port' => $dbConfig['port'] ?? 3306
        ];
    }
    
    /**
     * Full database backup
     */
    public function backup()
    {
        try {
            $filename = 'full_backup_' . date('Y-m-d_H-i-s') . '.sql';
            $filepath = $this->backupPath . $filename;
            
            // Get database config
            $dbConfig = $this->getDatabaseConfig();
            
            // Try mysqldump first
            if ($this->tryMysqlDump($filepath, $dbConfig)) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Backup berhasil dibuat: ' . $filename,
                    'filename' => $filename
                ]);
            }
            
            // Fallback to PHP-based backup
            $this->createPhpBackup($filepath);
            
            if (file_exists($filepath) && filesize($filepath) > 0) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Backup berhasil dibuat: ' . $filename,
                    'filename' => $filename
                ]);
            } else {
                throw new \Exception('File backup tidak dapat dibuat atau kosong');
            }
            
        } catch (\Exception $e) {
            log_message('error', 'Backup Error: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal membuat backup: ' . $e->getMessage()
            ]);
        }
    }
    
    /**
     * Backup selected tables
     */
    public function backupTables()
    {
        try {
            $tables = $this->request->getPost('tables');
            
            if (empty($tables) || !is_array($tables)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Pilih minimal satu tabel'
                ]);
            }
            
            $filename = 'selective_backup_' . date('Y-m-d_H-i-s') . '.sql';
            $filepath = $this->backupPath . $filename;
            
            // Get database config
            $dbConfig = $this->getDatabaseConfig();
            
            // Try mysqldump first
            if ($this->tryMysqlDumpTables($filepath, $dbConfig, $tables)) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Backup tabel terpilih berhasil dibuat: ' . $filename,
                    'filename' => $filename
                ]);
            }
            
            // Fallback to PHP-based backup
            $this->createPhpBackupTables($filepath, $tables);
            
            if (file_exists($filepath) && filesize($filepath) > 0) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Backup tabel terpilih berhasil dibuat: ' . $filename,
                    'filename' => $filename
                ]);
            } else {
                throw new \Exception('File backup tidak dapat dibuat atau kosong');
            }
            
        } catch (\Exception $e) {
            log_message('error', 'Backup Tables Error: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal membuat backup tabel: ' . $e->getMessage()
            ]);
        }
    }
    
    /**
     * Try to use mysqldump for full backup
     */
    private function tryMysqlDump($filepath, $dbConfig)
    {
        try {
            $command = sprintf(
                'mysqldump --host=%s --port=%d --user=%s --password=%s --single-transaction --routines --triggers %s > %s 2>&1',
                escapeshellarg($dbConfig['hostname']),
                $dbConfig['port'],
                escapeshellarg($dbConfig['username']),
                escapeshellarg($dbConfig['password']),
                escapeshellarg($dbConfig['database']),
                escapeshellarg($filepath)
            );
            
            exec($command, $output, $returnCode);
            
            return ($returnCode === 0 && file_exists($filepath) && filesize($filepath) > 0);
            
        } catch (\Exception $e) {
            log_message('error', 'MySQLDump Error: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Try to use mysqldump for selected tables
     */
    private function tryMysqlDumpTables($filepath, $dbConfig, $tables)
    {
        try {
            $tableList = implode(' ', array_map('escapeshellarg', $tables));
            
            $command = sprintf(
                'mysqldump --host=%s --port=%d --user=%s --password=%s --single-transaction --routines --triggers %s %s > %s 2>&1',
                escapeshellarg($dbConfig['hostname']),
                $dbConfig['port'],
                escapeshellarg($dbConfig['username']),
                escapeshellarg($dbConfig['password']),
                escapeshellarg($dbConfig['database']),
                $tableList,
                escapeshellarg($filepath)
            );
            
            exec($command, $output, $returnCode);
            
            return ($returnCode === 0 && file_exists($filepath) && filesize($filepath) > 0);
            
        } catch (\Exception $e) {
            log_message('error', 'MySQLDump Tables Error: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * PHP-based backup (fallback method)
     */
    private function createPhpBackup($filepath)
    {
        $tables = $this->db->listTables();
        $this->createPhpBackupTables($filepath, $tables);
    }
    
    /**
     * PHP-based backup for selected tables
     */
    private function createPhpBackupTables($filepath, $tables)
    {
        $sql = "-- Database Backup Created: " . date('Y-m-d H:i:s') . "\n";
        $sql .= "-- Generated by CodeIgniter Backup System\n\n";
        $sql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";
        
        foreach ($tables as $table) {
            try {
                // Get table structure
                $createTableQuery = $this->db->query("SHOW CREATE TABLE `{$table}`");
                $createTable = $createTableQuery->getRow();
                
                $sql .= "-- Structure for table `{$table}`\n";
                $sql .= "DROP TABLE IF EXISTS `{$table}`;\n";
                $sql .= $createTable->{'Create Table'} . ";\n\n";
                
                // Get table data
                $dataQuery = $this->db->query("SELECT * FROM `{$table}`");
                $rows = $dataQuery->getResult();
                
                if (!empty($rows)) {
                    $sql .= "-- Data for table `{$table}`\n";
                    
                    // Get column names
                    $fields = $dataQuery->getFieldNames();
                    $fieldList = '`' . implode('`, `', $fields) . '`';
                    
                    $sql .= "INSERT INTO `{$table}` ({$fieldList}) VALUES\n";
                    
                    $values = [];
                    foreach ($rows as $row) {
                        $rowValues = [];
                        foreach ($fields as $field) {
                            $value = $row->$field;
                            if ($value === null) {
                                $rowValues[] = 'NULL';
                            } else {
                                $rowValues[] = "'" . addslashes($value) . "'";
                            }
                        }
                        $values[] = '(' . implode(', ', $rowValues) . ')';
                    }
                    
                    $sql .= implode(",\n", $values) . ";\n\n";
                }
            } catch (\Exception $e) {
                log_message('error', 'Error backing up table ' . $table . ': ' . $e->getMessage());
                continue;
            }
        }
        
        $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";
        
        // Write to file
        file_put_contents($filepath, $sql);
    }
    
        /**
     * Restore database from backup file
     */
    public function restore()
    {
        try {
            $file = $this->request->getFile('backup_file');
            $db   = \Config\Database::connect();
    
            if (!$file->isValid()) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'File backup tidak valid: ' . $file->getErrorString()
                ]);
            }
    
            // Validasi ekstensi file
            $extension = strtolower($file->getClientExtension() ?? pathinfo($file->getName(), PATHINFO_EXTENSION));
            if ($extension !== 'sql') {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'File harus berformat .sql'
                ]);
            }
    
            // Baca konten file SQL
            $sqlContent = file_get_contents($file->getTempName());
            if (empty($sqlContent)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Isi file kosong'
                ]);
            }
    
            // Optional: Hapus semua tabel sebelum restore (hati-hati!)
            // $tables = $db->listTables();
            // foreach ($tables as $table) {
            //     $db->query("DROP TABLE IF EXISTS `$table`");
            // }
    
            // Pecah SQL per perintah (menghilangkan komentar dan baris kosong)
            $sqlCommands = array_filter(
                array_map('trim', explode(';', $sqlContent)),
                function ($cmd) {
                    return $cmd !== '' && strpos($cmd, '--') !== 0;
                }
            );
    
            $db->transBegin();
            $errors = [];
    
            foreach ($sqlCommands as $command) {
                try {
                    if (!empty(trim($command))) {
                        $db->query($command);
                    }
                } catch (\Throwable $e) {
                    $errors[] = $e->getMessage();
                }
            }
    
            if (!empty($errors)) {
                $db->transRollback();
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Beberapa query gagal dijalankan.',
                    'errors' => $errors
                ]);
            }
    
            $db->transCommit();
    
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Restore berhasil dilakukan.'
            ]);
        } catch (\Throwable $e) {
            log_message('error', 'Restore Error: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat restore: ' . $e->getMessage()
            ]);
        }
    }
    

    
    /**
     * List available backup files
     */
    public function listBackups()
    {
        try {
            if (!is_dir($this->backupPath)) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'data' => []
                ]);
            }
            
            $files = glob($this->backupPath . '*.sql');
            $backups = [];
            
            foreach ($files as $file) {
                $filename = basename($file);
                $size = $this->formatFileSize(filesize($file));
                $date = date('d-m-Y H:i:s', filemtime($file));
                
                $backups[] = [
                    'filename' => $filename,
                    'size' => $size,
                    'date' => $date
                ];
            }
            
            // Sort by date (newest first)
            usort($backups, function($a, $b) {
                return strtotime($b['date']) - strtotime($a['date']);
            });
            
            return $this->response->setJSON([
                'status' => 'success',
                'data' => $backups
            ]);
            
        } catch (\Exception $e) {
            log_message('error', 'List Backups Error: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal mengambil daftar backup: ' . $e->getMessage()
            ]);
        }
    }
    
    /**
     * Download backup file
     */
    public function downloadBackup($filename)
    {
        try {
            $filepath = $this->backupPath . $filename;
            
            if (!file_exists($filepath)) {
                throw new \Exception('File tidak ditemukan');
            }
            
            return $this->response->download($filepath, null);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal download file: ' . $e->getMessage());
        }
    }
    
    /**
     * Delete backup file
     */
    public function deleteBackup($filename)
    {
        try {
            $filepath = $this->backupPath . $filename;
            
            if (!file_exists($filepath)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'File tidak ditemukan'
                ]);
            }
            
            if (unlink($filepath)) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'File backup berhasil dihapus'
                ]);
            } else {
                throw new \Exception('Gagal menghapus file');
            }
            
        } catch (\Exception $e) {
            log_message('error', 'Delete Backup Error: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menghapus file: ' . $e->getMessage()
            ]);
        }
    }
    
    /**
     * Format file size
     */
    private function formatFileSize($size)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $size > 1024 && $i < count($units) - 1; $i++) {
            $size /= 1024;
        }
        
        return round($size, 2) . ' ' . $units[$i];
    }
    
    /**
     * Test method for debugging
     */
    public function test()
    {
        try {
            $tables = $this->db->listTables();
            $dbConfig = $this->getDatabaseConfig();
            
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Database connected successfully',
                'tables_count' => count($tables),
                'tables' => $tables,
                'db_config' => [
                    'hostname' => $dbConfig['hostname'],
                    'database' => $dbConfig['database'],
                    'port' => $dbConfig['port']
                ]
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
}
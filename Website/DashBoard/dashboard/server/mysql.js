const mysql = require('mysql');

const pool = mysql.createPool({
    connectionLimit: 10,
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'online_learning_system'
});

function sqlFun(sql, arr, callback) {
    pool.getConnection((err, connection) => {
        if (err) {
            console.error('获取数据库连接失败:', err);
            return;
        }
        connection.query(sql, arr, (error, result) => {
            connection.release(); // 释放连接
            if (error) {
                console.error('数据库语句错误:', error);
                return;
            }
            callback(result);
        });
    });
}

module.exports = sqlFun;

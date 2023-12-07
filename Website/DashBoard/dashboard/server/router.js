const express = require('express')
const router = express.Router()
// 导入数据库 sqlFun
const sqlFn = require('./mysql')

// 路由接口 

router.get('/projectList', (req, res) => {
    const page = req.query.page || 1;

    const sqlLen = 'SELECT * FROM courselist WHERE CourseID';//查询总数
    sqlFn(sqlLen, null, data => {
        let len = data.length; 

        const sql = `SELECT * FROM courselist ORDER BY CourseID DESC LIMIT 8 OFFSET` + (page - 1) * 8;
        sqlFn(sql, null, result => {
            if (result.length > 0) {
                res.send({
                    status: 200,
                    data: result,
                    pageSize: 8,
                    total: len
                });
            } else {
                res.send({
                    status: 500,
                    msg: "No data"
                });
            }
        });
    })
})

module.exports = router
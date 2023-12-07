// 请求方法
import axios from "axios"
import base from "./base"

const api = {
    // 课程列表
    getCourseList(params){
        return axios.get(base.courseList,{
            params
        })
    }
}
export default api
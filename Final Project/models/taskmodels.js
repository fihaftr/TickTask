const db = require('../db');

const TaskModel = {
  async getAll() {
    const [rows] = await db.query('SELECT * FROM tasks ORDER BY id DESC');
    return rows;
  },

  async getById(id) {
    const [rows] = await db.query('SELECT * FROM tasks WHERE id = ?', [id]);
    return rows[0];
  },

  async add(data) {
    const sql = 'INSERT INTO tasks (title, detail, category, status, due) VALUES (?, ?, ?, ?, ?)';
    const [result] = await db.execute(sql, [data.title, data.detail, data.category, data.status, data.due]);
    return result;
  },

  async update(id, data) {
    const sql = 'UPDATE tasks SET title=?, detail=?, category=?, status=?, due=? WHERE id=?';
    const [result] = await db.execute(sql, [data.title, data.detail, data.category, data.status, data.due, id]);
    return result;
  },

  async delete(id) {
    const [result] = await db.execute('DELETE FROM tasks WHERE id = ?', [id]);
    return result;
  }
};

module.exports = TaskModel;

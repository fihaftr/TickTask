const express = require("express");
const router = express.Router();
const db = require("../database");

router.get("/tasks", async (req, res) => {
  const [rows] = await db.query("SELECT * FROM tasks ORDER BY id DESC");
  res.json(rows);
});

router.get("/tasks/:id", async (req, res) => {
  const [rows] = await db.query("SELECT * FROM tasks WHERE id = ?", [req.params.id]);
  res.json(rows[0]);
});

router.post("/tasks", async (req, res) => {
  const { title, detail, category, status, due } = req.body;
  const sql = "INSERT INTO tasks (title, detail, category, status, due) VALUES (?, ?, ?, ?, ?)";
  const [result] = await db.execute(sql, [title, detail, category, status, due]);
  res.json({ success: result.affectedRows > 0 });
});

router.put("/tasks/:id", async (req, res) => {
  const { title, detail, category, status, due } = req.body;
  const [result] = await db.execute(
    "UPDATE tasks SET title=?, detail=?, category=?, status=?, due=? WHERE id=?",
    [title, detail, category, status, due, req.params.id]
  );
  res.json({ success: result.affectedRows > 0 });
});

router.delete("/tasks/:id", async (req, res) => {
  const [result] = await db.execute("DELETE FROM tasks WHERE id = ?", [req.params.id]);
  res.json({ success: result.affectedRows > 0 });
});

module.exports = router;

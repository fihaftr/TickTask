const express = require("express");
const mysql = require("mysql2");
const cors = require("cors");

const app = express();
const port = 3000;

app.use(cors());
app.use(express.json());

const db = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "root",
  database: "ticktask",
});

db.connect((err) => {
  if (err) {
    console.error("Database connection failed:", err);
    return;
  }
  console.log("Connected to MySQL database ✅");
});

app.get("/api/tasks/:id", (req, res) => {
  const { id } = req.params;
  const sql = "SELECT * FROM tasks WHERE id = ?";
  db.query(sql, [id], (err, result) => {
    if (err) return res.status(500).json({ error: "Database error" });
    if (result.length === 0)
      return res.status(404).json({ error: "Task not found" });
    res.json(result[0]);
  });
});

app.post("/api/tasks", (req, res) => {
  const { title, detail, category, status, due } = req.body;
  if (!title || !detail || !category || !status || !due) {
    return res.status(400).json({ error: "Missing fields" });
  }

  const dueFormatted = new Date(due).toISOString().slice(0, 10); // YYYY-MM-DD
  const sql =
    "INSERT INTO tasks (title, detail, category, status, due) VALUES (?, ?, ?, ?, ?)";
  db.query(
    sql,
    [title, detail, category, status, dueFormatted],
    (err, result) => {
      if (err) return res.status(500).json({ error: "Database error" });
      res.status(201).json({ message: "Task added", taskId: result.insertId });
    }
  );
});

app.put("/api/tasks/:id", (req, res) => {
  const { title, detail, category, status, due } = req.body;
  const { id } = req.params;

  const dueFormatted = new Date(due).toISOString().slice(0, 10);
  const sql =
    "UPDATE tasks SET title=?, detail=?, category=?, status=?, due=? WHERE id=?";
  db.query(
    sql,
    [title, detail, category, status, dueFormatted, id],
    (err, result) => {
      if (err) return res.status(500).json({ error: "Database error" });
      res.json({ message: "Task updated" });
    }
  );
});

app.delete("/api/tasks/:id", (req, res) => {
  const { id } = req.params;
  const sql = "DELETE FROM tasks WHERE id = ?";
  db.query(sql, [id], (err, result) => {
    if (err) return res.status(500).json({ error: "Database error" });
    res.json({ message: "Task deleted" });
  });
});

app.listen(port, () => {
  console.log(`Server ready on http://localhost:${port}`);
});

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela To-Do</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
        }

        .tables-wrapper {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            gap: 30px;
            align-items: flex-start;
        }

        .table-section {
            flex: 1 1 300px;
            min-width: 280px;
        }

        .table-section h2 {
            color: #000000;
            font-size: 16px;
            padding: 10px 15px;
            border-radius: 4px 4px 0 0;
            margin-bottom: 0;
        }

        .section-do h2 {
            background-color: #ff6b6b;
        }

        .section-w-trakcie h2 {
            background-color: #ffd93d;
            color: #333;
        }

        .section-zrobione h2 {
            background-color: #6bcf7f;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }

        table thead {
            background-color: #f8f9fa;
        }

        table th {
            padding: 12px 15px;
            text-align: left;
            font-weight: bold;
            color: #333;
            border-bottom: 2px solid #ddd;
        }

        table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            color: #555;
        }

        table tbody tr:hover {
            background-color: #f9f9f9;
        }

        .lp-col {
            width: 50px;
            text-align: center;
            color: #999;
            font-weight: bold;
        }

        .task-col {
            text-align: left;
        }

        .empty-row {
            text-align: center;
            color: #ccc;
            padding: 20px;
            font-style: italic;
        }

        .add-task-section {
            margin-bottom: 30px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #ff6b6b;
        }

        .add-task-section h3 {
            color: #333;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .input-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .input-group input {
            flex: 1;
            min-width: 250px;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .input-group input:focus {
            outline: none;
            border-color: #ff6b6b;
            box-shadow: 0 0 5px rgba(255, 107, 107, 0.3);
        }

        .input-group button {
            padding: 10px 30px;
            background-color: #ff6b6b;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .input-group button:hover {
            background-color: #ee5a52;
        }

        .input-group button:active {
            background-color: #dd4a42;
        }

        .delete-btn {
            background-color: #ff6b6b;
            border: none;
            color: white;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
            width: 35px;
            height: 35px;
        }

        .delete-btn:hover {
            background-color: #ee5a52;
        }

        .delete-btn:active {
            background-color: #dd4a42;
        }
    </style>
        <style>
        @media (max-width: 900px) {
            .tables-wrapper {
                flex-direction: column;
            }
            .table-section {
                width: 100%;
                min-width: auto;
                flex: none;
            }
        }
        </style>
</head>
<body>
    <div class="container">
        <h1>Lista Zadań</h1>

        <div class="add-task-section">
            <h3>Dodaj nowe zadanie</h3>
            <div class="input-group">
                <input type="text" id="taskInput" placeholder="Wpisz treść zadania..." />
                <button id="addBtn">Dodaj</button>
            </div>
        </div>

        <div class="tables-wrapper">
            
            <div class="table-section section-do">
                <h2>Do zrobienia</h2>
                <table>
                    <tbody id="todo-table">
                    </tbody>
                </table>
            </div>

            
            <div class="table-section section-w-trakcie">
                <h2>W trakcie robienia </h2>
                <table>
                    <tbody id="inprogress-table">
                    </tbody>
                </table>
            </div>

            
            <div class="table-section section-zrobione">
                <h2>Zrobione</h2>
                <table>
                    <tbody id="done-table">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Wczytaj zadania przy otwarciu strony
        function loadTasks() {
            fetch('tasks.php?action=get')
                .then(response => response.json())
                .then(data => {
                    populateTables(data);
                })
                .catch(error => console.error('Błąd wczytywania zadań:', error));
        }

        // Wyświetl zadania w tabelach
        function populateTables(tasks) {
            const todoTable = document.getElementById('todo-table');
            const inprogressTable = document.getElementById('inprogress-table');
            const doneTable = document.getElementById('done-table');

            todoTable.innerHTML = '';
            inprogressTable.innerHTML = '';
            doneTable.innerHTML = '';

            let todoNum = 1, inprogressNum = 1, doneNum = 1;

            tasks.forEach(task => {
                const tr = document.createElement('tr');
                let numCol;

                if (task.status === 'todo') {
                    numCol = todoNum++;
                    tr.innerHTML = `<td class="lp-col">${numCol}</td><td>${task.text}</td><td style="text-align: center; width: 50px;"><button class="delete-btn" onclick="deleteTask(${task.id})">×</button></td>`;
                    todoTable.appendChild(tr);
                } else if (task.status === 'inprogress') {
                    numCol = inprogressNum++;
                    tr.innerHTML = `<td class="lp-col">${numCol}</td><td>${task.text}</td><td style="text-align: center; width: 50px;"><button class="delete-btn" onclick="deleteTask(${task.id})">×</button></td>`;
                    inprogressTable.appendChild(tr);
                } else if (task.status === 'done') {
                    numCol = doneNum++;
                    tr.innerHTML = `<td class="lp-col">${numCol}</td><td>${task.text}</td><td style="text-align: center; width: 50px;"><button class="delete-btn" onclick="deleteTask(${task.id})">×</button></td>`;
                    doneTable.appendChild(tr);
                }
            });
        }

        // Dodaj nowe zadanie
        function addTask() {
            const input = document.getElementById('taskInput');
            const text = input.value.trim();

            if (!text) {
                alert('Wpisz treść zadania!');
                return;
            }

            fetch('tasks.php?action=add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ text: text, status: 'todo' })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    input.value = '';
                    loadTasks();
                } else {
                    alert('Błąd przy dodawaniu zadania');
                }
            })
            .catch(error => console.error('Błąd:', error));
        }

        // Event listener dla przycisku
        document.getElementById('addBtn').addEventListener('click', addTask);

        // Możliwość dodania zadania przez Enter
        document.getElementById('taskInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                addTask();
            }
        });

        // Usuń zadanie
        function deleteTask(taskId) {
            if (confirm('Czy na pewno chcesz usunąć to zadanie?')) {
                fetch('tasks.php?action=delete', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: taskId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        loadTasks();
                    } else {
                        alert('Błąd przy usuwaniu zadania');
                    }
                })
                .catch(error => console.error('Błąd:', error));
            }
        }

        // Wczytaj zadania przy otwarciu strony
        window.addEventListener('load', loadTasks);
    </script>
</body>
</html>

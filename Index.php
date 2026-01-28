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
            font-family: Arial, Verdana, sans-serif;
            background-color: #0066CC;
            padding: 20px;
            min-height: 100vh;
            color: #000;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #C0C0C0;
            padding: 30px;
            border: 2px solid;
            border-color: #DFDFDF #808080 #808080 #DFDFDF;
            box-shadow: 1px 1px 0 #FFFFFF inset, -1px -1px 0 #808080 inset;
        }

        h1 {
            text-align: center;
            color: #000080;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 0;
            text-shadow: none;
            font-family: Arial, Verdana, sans-serif;
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
            border-radius: 0;
            overflow: hidden;
            box-shadow: none;
        }

        .table-section h2 {
            color: #ffffff;
            font-size: 14px;
            padding: 2px 4px;
            border-radius: 0;
            margin-bottom: 0;
            font-weight: bold;
            letter-spacing: 0;
            border-bottom: none;
            font-family: Arial, Verdana, sans-serif;
            border: none;
        }

        .section-do h2 {
            background: linear-gradient(90deg, #000080, #1084D7);
            border-color: none;
            color: #FFFFFF;
        }

        .section-w-trakcie h2 {
            background: linear-gradient(90deg, #000080, #1084D7);
            border-color: none;
            color: #FFFFFF;
        }

        .section-zrobione h2 {
            background: linear-gradient(90deg, #000080, #1084D7);
            border-color: none;
            color: #FFFFFF;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #C0C0C0;
            border: 1px solid;
            border-color: #DFDFDF #808080 #808080 #DFDFDF;
        }

        .section-do table {
            border-color: #DFDFDF #808080 #808080 #DFDFDF;
        }

        .section-w-trakcie table {
            border-color: #DFDFDF #808080 #808080 #DFDFDF;
        }

        .section-zrobione table {
            border-color: #DFDFDF #808080 #808080 #DFDFDF;
        }

        table thead {
            background-color: #C0C0C0;
        }

        table th {
            padding: 4px 8px;
            text-align: left;
            font-weight: bold;
            color: #000;
            border: 1px solid;
            border-color: #DFDFDF #808080 #808080 #DFDFDF;
            background: linear-gradient(180deg, #E0E0E0, #C0C0C0);
            font-size: 12px;
        }

        table td {
            padding: 4px 8px;
            border: 1px solid #C0C0C0;
            color: #000;
            background-color: #FFFFFF;
            font-size: 12px;
        }

        table tbody tr {
            background-color: #FFFFFF;
        }

        table tbody tr:nth-child(even) {
            background-color: #F0F0F0;
        }

        table tbody tr:hover {
            background-color: #E8E8E8 !important;
        }

        .lp-col {
            width: 50px;
            text-align: center;
            color: #000;
            font-weight: bold;
            font-size: 12px;
            font-family: Arial, Verdana, sans-serif;
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
            padding: 10px;
            background-color: #C0C0C0;
            border-radius: 0;
            border: 2px solid;
            border-color: #DFDFDF #808080 #808080 #DFDFDF;
            box-shadow: none;
        }

        .add-task-section h3 {
            color: #000;
            margin-bottom: 15px;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 0;
            font-family: Arial, Verdana, sans-serif;
        }

        .input-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .input-group input {
            flex: 1;
            min-width: 250px;
            padding: 3px 4px;
            border: 2px solid;
            border-color: #808080 #DFDFDF #DFDFDF #808080;
            border-radius: 0;
            font-size: 12px;
            background-color: #FFFFFF;
            color: #000;
            font-family: Arial, Verdana, sans-serif;
            box-shadow: none;
        }

        .input-group input::placeholder {
            color: #999;
        }

        .input-group input:focus {
            outline: none;
            border-color: #000080;
        }

        .input-group button {
            padding: 4px 12px;
            background: linear-gradient(180deg, #E8E8E8, #C0C0C0);
            color: #000;
            border: 2px solid;
            border-color: #DFDFDF #808080 #808080 #DFDFDF;
            border-radius: 0;
            font-size: 11px;
            font-weight: bold;
            cursor: pointer;
            transition: none;
            letter-spacing: 0;
            text-transform: none;
            font-family: Arial, Verdana, sans-serif;
            box-shadow: none;
            margin: 0 auto;
        }

        .input-group button:hover {
            background: linear-gradient(180deg, #F0F0F0, #D0D0D0);
        }

        .input-group button:active {
            border-color: #808080 #DFDFDF #DFDFDF #808080;
            background: linear-gradient(180deg, #C0C0C0, #E8E8E8);
        }

        .delete-btn {
            background: linear-gradient(180deg, #E8E8E8, #C0C0C0);
            border: 2px solid;
            border-color: #DFDFDF #808080 #808080 #DFDFDF;
            color: #000;
            padding: 2px 6px;
            text-align: center;
            text-decoration: none;
            display: block;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 0;
            transition: none;
            width: 24px;
            height: 24px;
            line-height: 1;
            font-family: Arial, Verdana, sans-serif;
            box-shadow: none;
            margin: 0 auto;
        }

        .delete-btn:hover {
            background: linear-gradient(180deg, #F0F0F0, #D0D0D0);
        }

        .delete-btn:active {
            border-color: #808080 #DFDFDF #DFDFDF #808080;
            background: linear-gradient(180deg, #C0C0C0, #E8E8E8);
        }

        .move-btn {
            background: linear-gradient(180deg, #E8E8E8, #C0C0C0);
            border: 2px solid;
            border-color: #DFDFDF #808080 #808080 #DFDFDF;
            color: #000;
            padding: 2px 6px;
            text-align: center;
            text-decoration: none;
            display: block;
            font-size: 10px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 0;
            transition: none;
            text-transform: none;
            letter-spacing: 0;
            font-family: Arial, Verdana, sans-serif;
            box-shadow: none;
            margin: 0 auto;
        }

        .move-btn:hover {
            background: linear-gradient(180deg, #F0F0F0, #D0D0D0);
        }

        .move-btn:active {
            border-color: #808080 #DFDFDF #DFDFDF #808080;
            background: linear-gradient(180deg, #C0C0C0, #E8E8E8);
        }

        .action-cell {
            text-align: center;
            width: 80px;
            display: block;
            padding: 0;
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
                    tr.innerHTML = `<td class="lp-col">${numCol}</td><td>${task.text}</td><td><button class="move-btn" onclick="changeStatus(${task.id}, 'inprogress')">Rozpocznij</button></td><td><button class="delete-btn" onclick="deleteTask(${task.id})">×</button></td>`;
                    todoTable.appendChild(tr);
                } else if (task.status === 'inprogress') {
                    numCol = inprogressNum++;
                    tr.innerHTML = `<td class="lp-col">${numCol}</td><td>${task.text}</td><td><button class="move-btn" onclick="changeStatus(${task.id}, 'done')">Ukończ</button></td><td><button class="delete-btn" onclick="deleteTask(${task.id})">×</button></td>`;
                    inprogressTable.appendChild(tr);
                } else if (task.status === 'done') {
                    numCol = doneNum++;
                    tr.innerHTML = `<td class="lp-col">${numCol}</td><td>${task.text}</td><td></td><td><button class="delete-btn" onclick="deleteTask(${task.id})">×</button></td>`;
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

        // Zmień status zadania
        function changeStatus(taskId, newStatus) {
            fetch('tasks.php?action=update-status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: taskId, status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadTasks();
                } else {
                    alert('Błąd przy zmianie statusu zadania');
                }
            })
            .catch(error => console.error('Błąd:', error));
        }

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

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
            color: #fff;
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
        <h1> Lista Zadań</h1>

        <div class="tables-wrapper">
            
            <div class="table-section section-do">
                <h2>Do zrobienia</h2>
                <table>
                    <tbody>
                        <tr>
                            <td class="lp-col">1</td>
                                <td>cos1</td>
                            </tr>
                        <tr>
                            <td class="lp-col">2</td>
                            <td>cos2</td>
                        </tr>
                        <tr>
                            <td class="lp-col">3</td>
                            <td>cos3</td>
                        </tr>
                        <tr>
                            <td class="lp-col">4</td>
                            <td>cos4</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            
            <div class="table-section section-w-trakcie">
                <h2>W trakcie robienia </h2>
                <table>
                    <tbody>
                        <tr>
                            <td class="lp-col">1</td>
                            <td>cos2</td>
                        </tr>
                        <tr>
                            <td class="lp-col">2</td>
                            <td>cos3</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            
            <div class="table-section section-zrobione">
                <h2>Zrobione</h2>
                <table>
                    <tbody>
                        <tr>
                            <td class="lp-col">1</td>
                            <td>cos1</td>
                        </tr>
                        <tr>
                            <td class="lp-col">2</td>
                            <td>cos2</td>
                        </tr>
                        <tr>
                            <td class="lp-col">3</td>
                            <td>cos3</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

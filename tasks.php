<?php
// tasks.php - Backend do zarządzania zadaniami

header('Content-Type: application/json');

$tasksFile = __DIR__ . '/tasks.json';

// Funkcja do wczytania zadań z pliku
function loadTasks() {
    global $tasksFile;
    if (!file_exists($tasksFile)) {
        return [];
    }
    $json = file_get_contents($tasksFile);
    return json_decode($json, true) ?? [];
}

// Funkcja do zapisania zadań do pliku
function saveTasks($tasks) {
    global $tasksFile;
    file_put_contents($tasksFile, json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// Obsługa żądań
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === 'get') {
    // Zwróć wszystkie zadania
    $tasks = loadTasks();
    echo json_encode($tasks);
} elseif ($action === 'add') {
    // Dodaj nowe zadanie
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($input['text']) || empty(trim($input['text']))) {
        echo json_encode(['success' => false, 'message' => 'Tekst zadania jest wymagany']);
        exit;
    }

    $tasks = loadTasks();
    
    // Utwórz nowe zadanie z unikalnym ID
    $newTask = [
        'id' => intval(microtime(true) * 100000),
        'text' => htmlspecialchars(trim($input['text']), ENT_QUOTES, 'UTF-8'),
        'status' => 'todo',
        'created' => date('Y-m-d H:i:s')
    ];
    
    $tasks[] = $newTask;
    saveTasks($tasks);
    
    echo json_encode(['success' => true, 'task' => $newTask]);
} elseif ($action === 'delete') {
    // Usuń zadanie po ID
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($input['id'])) {
        echo json_encode(['success' => false, 'message' => 'ID zadania jest wymagane']);
        exit;
    }

    $tasks = loadTasks();
    $idToDelete = $input['id'];
    $found = false;
    
    foreach ($tasks as $key => $task) {
        if ($task['id'] == $idToDelete) {
            unset($tasks[$key]);
            $found = true;
            break;
        }
    }
    
    if ($found) {
        $tasks = array_values($tasks);
        saveTasks($tasks);
        echo json_encode(['success' => true, 'message' => 'Zadanie usunięte']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Zadanie nie znalezione']);
    }
} elseif ($action === 'update-status') {
    // Zaktualizuj status zadania
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($input['id']) || !isset($input['status'])) {
        echo json_encode(['success' => false, 'message' => 'ID i status są wymagane']);
        exit;
    }

    $tasks = loadTasks();
    $idToUpdate = $input['id'];
    $found = false;
    
    foreach ($tasks as &$task) {
        if ($task['id'] == $idToUpdate) {
            $task['status'] = $input['status'];
            $found = true;
            break;
        }
    }
    
    if ($found) {
        saveTasks($tasks);
        echo json_encode(['success' => true, 'message' => 'Status zaktualizowany']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Zadanie nie znalezione']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Nieznana akcja']);
}
?>

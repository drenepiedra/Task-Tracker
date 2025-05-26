<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class TaskTracker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:manage {action} {--id=} {--title=} {--status=}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gestion de Task';

    private $filePath;

    public function __construct()
    {
        parent::__construct();
        $this->filePath = storage_path('tasks.json');
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = $this->argument('action');

        switch ($action) {
            case 'Adicionar':
                $this->addTask();
                break;
            case 'Actualizar':
                $this->updateTask();
                break;
            case 'Eliminar':
                $this->deleteTask();
                break;
            case 'Listar':
                $this->listTasks();
                break;
            case 'En Progreso':
                $this->listTasksByStatus('in_progress');
                break;
            case 'Hecho':
                $this->listTasksByStatus('done');
                break;
            case 'Pendiente':
                $this->listTasksByStatus('pending');
                break;
            default:
                $this->error('Acción no válida.');
        }
    }

    private function addTask()
    {
        $tasks = $this->getTasks();
        $id = count($tasks) + 1;
        $title = $this->option('Adicionar Tarea');
        $status = 'Pendiente';

        $tasks[] = ['id' => $id, 'title' => $title, 'status' => $status];
        $this->saveTasks($tasks);
        $this->info('Tarea agregada.');
    }


    private function updateTask()
    {
        $id = $this->option('id');
        $tasks = $this->getTasks();

        foreach ($tasks as &$task) {
            if ($task['id'] == $id) {
                $task['title'] = $this->option('title') ?? $task['title'];
                $task['status'] = $this->option('status') ?? $task['status'];
                $this->info('Tarea actualizada.');
                $this->saveTasks($tasks);
                return;
            }
        }
        $this->error('Tarea no encontrada.');
    }



    private function deleteTask()
    {
        $id = $this->option('id');
        $tasks = $this->getTasks();

        foreach ($tasks as $key => $task) {
            if ($task['id'] == $id) {
                unset($tasks[$key]);
                $this->saveTasks(array_values($tasks));
                $this->info('Tarea eliminada.');
                return;
            }
        }
        $this->error('Tarea no encontrada.');
    }

    private function listTasks()
    {
        $tasks = $this->getTasks();
        if (empty($tasks)) {
            $this->info('No hay tareas.');
        } else {
            foreach ($tasks as $task) {
                $this->info("ID: {$task['id']}, Título: {$task['title']}, Estado: {$task['status']}");
            }
        }
    }

    private function listTasksByStatus($status)
    {
        $tasks = $this->getTasks();
        $filteredTasks = array_filter($tasks, function ($task) use ($status) {
            return $task['status'] === $status;
        });

        if (empty($filteredTasks)) {
            $this->info('No hay tareas con el estado seleccionado.');
        } else {
            foreach ($filteredTasks as $task) {
                $this->info("ID: {$task['id']}, Título: {$task['title']}, Estado: {$task['status']}");
            }
        }
    }

    private function getTasks()
    {
        if (File::exists($this->filePath)) {
            $jsonContent = File::get($this->filePath);
            return json_decode($jsonContent, true);
        }
        return [];
    }

    private function saveTasks(array $tasks)
    {
        $jsonContent = json_encode($tasks, JSON_PRETTY_PRINT);
        File::put($this->filePath, $jsonContent);
    }
}

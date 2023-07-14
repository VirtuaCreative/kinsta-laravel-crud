<?php
  
namespace App\Console\Commands;
  
use Illuminate\Console\Command;
use File;
  
class MakeViewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:view {view}';
  
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new blade template.';
  
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $view = $this->argument('view');
  
        $path = $this->viewPath($view);
  
        $this->createDir($path);
  
        if (File::exists($path))
        {
            $this->error("File {$path} already exists!");
            return;
        }
  
        File::put($path, $path);
  
        $this->info("File {$path} created.");
    }
  
     /**
     * Get the view full path.
     *
     * @param string $view
     *
     * @return string
     */
    public function viewPath($view)
    {
        $view = str_replace('.', '/', $view) . '.blade.php';
  
        $path = "resources/views/{$view}";
  
        return $path;
    }
  
    /**
     * Create view directory if not exists.
     *
     * @param $path
     */
    public function createDir($path)
    {
        $dir = dirname($path);
  
        if (!file_exists($dir))
        {
            mkdir($dir, 0777, true);
        }
    }
}
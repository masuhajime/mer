<?php namespace Mer\ServiceProvider;

class GAEBladeCompiler extends \Illuminate\View\Compilers\BladeCompiler
{
    /**
	 * Compile the view at the given path.
	 *
	 * @param  string  $path
	 * @return void
	 */
	public function compile($path = null)
	{
		$this->footer = array();

		if ($path)
		{
			$this->setPath($path);
		}

        // GAEではtemplateを更新しないため
        if ('local' === \App::environment()) {
            $contents = $this->compileString($this->files->get($path));
        
            if ( ! is_null($this->cachePath))
            {
                $this->files->put($this->getCompiledPath($this->getPath()), $contents);
            }
        }
	}

    
    /**
     * Get the path to the compiled version of a view.
     *
     * @param  string  $path
     * @return string
     */
    public function getCompiledPath($path)
    {
        $md5_path = basename(dirname($path)).'/'.basename($path);
        return $this->cachePath.'/'.md5($md5_path);
    }
}

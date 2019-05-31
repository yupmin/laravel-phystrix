<?php

if (!function_exists('phystrix')) {
    /**
     * @return mixed
     * @throws Exception
     */
    function phystrix()
    {
        $arguments = func_get_args();

        if (empty($arguments)) {
            return app('phystrix.command-factory');
        }

        if (is_string($arguments[0])) {
            return app('phystrix.command-factory')->command(...$arguments);
        }

        throw new Exception('You must set pass some arguments.');
    }
}

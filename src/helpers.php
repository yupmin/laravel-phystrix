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
            return app('phystrix.command-factory')->getCommand(...$arguments);
        }

        throw new Exception('You must set pass some arguments.');
    }
}

if (!function_exists('phystrix_stream')) {
    /**
     * @return mixed
     * @throws Exception
     */
    function phystrix_stream()
    {
        $arguments = func_get_args();

        if (empty($arguments)) {
            return app('phystrix.stream');
        }

        throw new Exception('You must set pass none argument.');
    }
}

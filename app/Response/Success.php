<?php

    namespace App\Response;

    use App\Models\AuditLogs;
    use Illuminate\Http\Request;

    class Success
    {
        /**
         * @param $data
         * @param array $codeInternal
         * @param Request|null $request
         * @return \Illuminate\Http\JsonResponse|Mixed
         */
        public function returnType($data, array $codeInternal, string $routeType="web", string $redirectNameRoute=null)
        {
            if($routeType=="web")
            {
                if($redirectNameRoute==null)
                {
                    return back()
                        ->withInput()
                        ->with("success", $codeInternal["message"]);
                }
                else
                {
                    return redirect($redirectNameRoute)
                        ->withInput()
                        ->with("success", $codeInternal["message"]);
                }
            }
            else
            {
                return response()->json([
                    'code'       => $codeInternal["code"],
                    'status'     => "success",
                    'message'    => $codeInternal["message"],
                    'data'       => $data,
                    "url"        => $redirectNameRoute ?? null
                ]);
            }
        }

        /**
         * @param $data
         * @param array $codeInternal
         * @param Request|null $request
         * @return bool|\Illuminate\Http\RedirectResponse|void
         */
        public static function generic($data, array $codeInternal, string $routeType="web", string $redirectNameRoute=null)
        {
            return (new Success)->returnType($data, $codeInternal, $routeType, $redirectNameRoute);
        }

    }

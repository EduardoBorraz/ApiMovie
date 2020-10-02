<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Movie;
use DB;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    public function getMovie(Request $request){
        //$parameters = $request->all();
        //$movie = Movie::all();
        try {
            $res = DB::table('movies')
            ->select(
                'movies.idmovies','movies.Title','movies.Director',
                'movies.Country','movies.Qualification','movies.Year',
                'movies.created_at','movies.updated_at',
                'movies.id_users',
                    'person.idperson as idB','person.user as userB',
                    'person.password as passwordB',
                    'person.Name as NameB','person.Paternal as PaternalB','person.Maternal as MaternalB','person.Token as TokenB',

                'movies.id_genre_movie',
                    'cat_genre_movie.id_genre_movie as idC',
                    'cat_genre_movie.Genre as GenreC',
            )
            ->leftJoin('person','person.idperson','=','movies.id_users')
            ->leftJoin('cat_genre_movie',
            'cat_genre_movie.id_genre_movie','=','movies.id_genre_movie')
            ->get();
            
            //dd($res);
            $total = $res->count();
            $array_res = [];
            $temp = [];
            $data_temp = [];

            
           foreach($res as $data){
            $temp = [
               
                'idmovies'=>$data->idmovies,
                'Title'=>$data->Title,
                'Director'=>$data->Director,
                'Country'=>$data->Country,
                'Qualification'=>$data->Qualification,
                'Year'=>$data->Year,
                'idusers'=>[
                    'idusers'=>$data->idB,
                    'user'=>$data->userB,
                    'password'=>$data->passwordB,
                    'Name'=>$data->NameB,
                    'Paternal'=>$data->PaternalB,
                    'Maternal'=>$data->MaternalB,
                    'Token'=>$data->TokenB
                ],
                'id_genre_movie'=>[
                    'id_genre_movie'=>$data->idC,
                    'Gnere'=>$data->GenreC
                ]
            ];
            //dd($temp);
            $data_temp = $temp;
            array_push($array_res,$data_temp);
           }

           return [
            'success'=>true,
            'Message'=>'List of Movie',
            'total'=>$total,
            'data'=>$array_res
           ];

        } catch (QueryException $e) {
            //throw $th;
            return [
                'success' => false,
                'errors' => $e->getMessage()
            ];
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\FlavorService;
use Illuminate\Http\Request;
use App\Http\Requests\FlavorCreatRequest;


/**
 * Class FlavorController
 *
 * @package App\Http\Controllers
 * @author Vinícius Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 2024-10-01 15:52:04
 * @copyright UniEVANGÉLICA
 */
class FlavorController extends Controller
{
    protected $flavorService;

    public function __construct(FlavorService $flavorService)
    /**
     * Display a listing of the resource.
     */
    {
        $this->flavorService = $flavorService;
    }
    
    public function index()
    {
        $flavors = $this->flavorService->getAllFlavors();

        return [
            'status' => 200,
            'message' => 'Sabores encontrados!!',
            'sabores' => $flavors
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FlavorCreatRequest $request)
    {
        $flavor = $this->flavorService->createFlavor($request->all());
         
        return [
            'status' => 200,
            'message' => 'Sabor cadastrado com sucesso!!',
            'sabor' => $flavor
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $flavor =$this->flavorService->getFlavorById($id);

        if(!$flavor){
            return [
                'status' => 404,
                'message' => 'Sabor não encontrado! Que triste!',
                'user' => $flavor
            ];
        }

        return [
            'status' => 200,
            'message' => 'Sabor encontrado com sucesso!!',
            'user' => $flavor
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $flavor = $this->flavorService->updateFlavor($id, $request->all());

        if(!$flavor){
            return [
                'status' => 404,
                'message' => 'Sabor não encontrado! Que triste!',
                'user' => $flavor
            ];
        }

        return [
            'status' => 200,
            'message' => 'Sabor atualizado com sucesso!!',
            'user' => $flavor
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $flavor =  $this->flavorService->deleteFlavor($id);

        if(!$flavor){
            return [
                'status' => 404,
                'message' => 'Sabor não encontrado! Que triste!',
                'user' => $flavor
            ];
        }

        return [
            'status' => 200,
            'message' => 'Sabor deletado com sucesso!!'
        ];

    }
}

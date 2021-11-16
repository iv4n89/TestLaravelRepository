<?php

namespace App\Repositories;

use App\Exceptions\User\UserNotFoundException;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Repositories\BaseRepository;
use Exception;

final class UserRepositoryImpl extends BaseRepository implements UserRepositoryInterface
{
    /** @var string $model */
    protected string $model = User::class;

    /**
     * Busca un user en la db por nombre. Si no lo encuentra lanzará una excepción
     *
     * @param string $name nombre del user a buscar
     * @return User user encontrado en la base de datos, si no lo encuetra se lanza excepcion
     * @throws UserNotFoundException si no encuentra el user en la db
     */
    public function showByName(string $name): User
    {
        $userFound = null;
        try{
            $userFound = User::where('name', $name)->firstOrFail();
        }catch(Exception $ex) {
            throw new $this->notFoundException($this->notFoundMessage);
        }
        return $userFound;
    }

    /**
     * Busca un usuario en la base de datos por email. Si no lo encuentra lanzará una excepción
     *
     * @param string $email email del usuario a buscar en la db
     * @return User user encontrado en la base de datos, si no lo encuentra lanzará excepcion
     * @throws UserNotFoundException si no encuentra el user en la db
     */
    public function showByEmail(string $email): User
    {
        $userFound = null;
        try{
            $userFound = User::where('email', $email)->firstOrFail();
        }catch(Exception $ex){
            throw new $this->notFoundException($this->notFoundMessage);
        }
        return $userFound;
    }
}
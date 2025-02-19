import { useState, useEffect} from 'react'
import Header from './components/Header'
import Guitarra from './components/Guitarra'
import {db} from './data/db'

function App() {
  const [data, setData] = useState(db);
  const carritoInicial = () => {
    const localStorageCarrito = localStorage.getItem('carrito')
    return (localStorageCarrito !== null) ? JSON.parse(localStorageCarrito) : []
  }

  const [carrito, setCarrito] = useState(carritoInicial);

  useEffect(() => {
    localStorage.setItem('carrito', JSON.stringify(carrito))
  }, [carrito])





  function anyadirAlCarrito(articulo) {
    const articuloExiste = carrito.findIndex(element => articulo.id === element.id)
    if (articuloExiste >= 0) {
      const copiaCarrito = [...carrito]
      copiaCarrito[articuloExiste].cantidad++
      setCarrito(copiaCarrito)
    }else{
      articulo.cantidad = 1
      setCarrito(carrito => [...carrito, articulo])
    }
  }

  function eliminarDelCarrito(id) {
    const nuevoCarrito = carrito.filter(element => element.id !== id)
    setCarrito(nuevoCarrito)
  }

  function menosCantidad(id) {
    const copiaCarrito = [...carrito]
    const articuloExiste = copiaCarrito.findIndex(element => element.id === id)
    if (copiaCarrito[articuloExiste].cantidad > 1) {
      copiaCarrito[articuloExiste].cantidad--
      setCarrito(copiaCarrito)
    }else{
      console.log('No se quita mas');
    }
  }

  function masCantidad(id) {
    const copiaCarrito = [...carrito]
    const articuloExiste = copiaCarrito.findIndex(element => element.id === id)
    copiaCarrito[articuloExiste].cantidad++
    setCarrito(copiaCarrito)
  }

  function limpiarCarrito() {
    setCarrito([])
  }

  useEffect(() => {
    setData(db)
  }
  , []);
  return (
    <>
      <Header
        carrito = {carrito}
        eliminarDelCarrito = {eliminarDelCarrito}
        menosCantidad = {menosCantidad}
        masCantidad = {masCantidad}
        limpiarCarrito = {limpiarCarrito}
      />
      <main className="container-xl mt-5">
        <h2 className="text-center">Nuestra Colección</h2>
        <div className="row mt-5">
          {data.map(element =>(
               <Guitarra
                  key = {element.id}
                  guitarraObj = {element}
                  anyadirAlCarrito = {anyadirAlCarrito}
               />
               )
          )}

        </div>
      </main>


      <footer className="bg-dark mt-5 py-5">
        <div className="container-xl">
          <p className="text-white text-center fs-4 mt-4 m-md-0">GuitarLA - Todos los derechos Reservados</p>
        </div>
      </footer>
    </>
  )
}

export default App

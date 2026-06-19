<!DOCTYPE html>
<html>
<head>
    <title>Laporan (React)</title>
    <link rel="stylesheet" href="../assets/style.css">
    <script src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <div id="root"></div>

<script type="text/babel">
    function LaporanList() {
        const [data, setData] = React.useState(null);
        const [selectedItem, setSelectedItem] = React.useState(null); 

        React.useEffect(() => {
            axios.get('controllers/api_laporan.php')
                .then(res => setData(Array.isArray(res.data) ? res.data : []))
                .catch(err => { console.error(err); setData([]); });
        }, []);

        const hapusData = (id) => {
            if(confirm("Yakin ingin menghapus laporan ini?")) {
                axios.delete('controllers/api_laporan.php?id=' + id)
                    .then(() => {
                        setData(data.filter(item => item.id !== id));
                    })
                    .catch(err => alert("Gagal menghapus data"));
            }
        };

        if (data === null) return <div style={{textAlign: 'center', marginTop: '50px'}}>Memuat data...</div>;

 
        if (!selectedItem) {
            return (
                <div className="container">
                    <h2 style={{marginBottom: '20px'}}>Daftar Laporan Pencemaran</h2>
                    <table className="tabel-react">
                        <thead>
                            <tr>
                                <th>Lokasi Sungai</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {data.map(item => (
                                <tr key={item.id}>
                                    <td>{item.lokasi_sungai}</td>
                                    <td>{item.kategori_pencemaran}</td>
                                    <td>{item.status_pencemaran}</td>
                                    <td>
                                        <button className="btn-primary" style={{padding: '8px 15px'}} onClick={() => setSelectedItem(item)}>Detail</button>
                                        <button className="btn-hapus" style={{marginLeft: '10px', padding: '8px 15px'}} onClick={() => hapusData(item.id)}>Hapus</button>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            );
        }

       
        return (
            <div className="container">
                {/* Menggunakan class card-container agar konsisten dengan desain Anda */}
                <div className="card-container">
                    <button className="btn-hapus" onClick={() => setSelectedItem(null)}>← Kembali</button>
                    <h2 style={{marginTop: '20px', marginBottom: '15px'}}>Detail: {selectedItem.lokasi_sungai}</h2>
                    <img src={'uploads/' + selectedItem.foto_bukti} alt="Bukti" style={{maxWidth: '300px', width: '100%', borderRadius: '15px', marginBottom: '15px'}} />
                    <p><strong>Kategori:</strong> {selectedItem.kategori_pencemaran}</p>
                    <p><strong>Status:</strong> {selectedItem.status_pencemaran}</p>
                    <p style={{marginTop: '10px'}}><strong>Deskripsi:</strong> {selectedItem.deskripsi}</p>
                </div>
            </div>
        );
    }

    const root = ReactDOM.createRoot(document.getElementById('root'));
    root.render(<LaporanList />);
</script>
</body>
</html>
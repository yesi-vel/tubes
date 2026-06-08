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
            axios.get('../api_laporan.php')
                .then(res => setData(Array.isArray(res.data) ? res.data : []))
                .catch(err => { console.error(err); setData([]); });
        }, []);

        // Fungsi Hapus (PENTING: Ditaruh di dalam LaporanList)
        const hapusData = (id) => {
            if(confirm("Yakin ingin menghapus laporan ini?")) {
                axios.delete('../api_laporan.php?id=' + id)
                    .then(() => {
                        setData(data.filter(item => item.id !== id));
                    })
                    .catch(err => alert("Gagal menghapus data"));
            }
        };

        if (data === null) return <div>Memuat data...</div>;

        // Tampilan Daftar
        if (!selectedItem) {
            return (
                <div className="container">
                    <h2>Daftar Laporan</h2>
                    <table className="tabel-react">
                        <thead>
                            <tr><th>Lokasi</th><th>Status</th><th>Aksi</th></tr>
                        </thead>
                        <tbody>
                            {data.map(item => (
                                <tr key={item.id}>
                                    <td>{item.lokasi_fasilitas}</td>
                                    <td>{item.status_kerusakan}</td>
                                    <td>
                                        <button className="btn-edit" onClick={() => setSelectedItem(item)}>Detail</button>
                                        <button className="btn-hapus" onClick={() => hapusData(item.id)} style={{marginLeft: '10px'}}>Hapus</button>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            );
        }

        // Tampilan Detail
        return (
            <div className="container">
                <div className="detail-card">
                    <button className="btn-hapus" onClick={() => setSelectedItem(null)}>← Kembali ke Daftar</button>
                    <h2 style={{marginTop: '20px'}}>Detail: {selectedItem.lokasi_fasilitas}</h2>
                    <img src={'../uploads/' + selectedItem.foto_bukti} alt="Bukti" style={{maxWidth: '300px', width: '100%'}} />
                    <p><strong>Status:</strong> {selectedItem.status_kerusakan}</p>
                    <p><strong>Deskripsi:</strong> {selectedItem.deskripsi}</p>
                </div>
            </div>
        );
    }

    const root = ReactDOM.createRoot(document.getElementById('root'));
    root.render(<LaporanList />);
</script>
</body>
</html>
import Nav from "@/Components/Tiket/Nav";
import { useForm } from "@inertiajs/react";
import React from "react";

// export default function ResultSearch(props) {
export default function ResultSearch({
    auth,
    search,
    dateAndDays,
    searchResults,
}) {
    console.log("result", searchResults[0]);
    console.log("result", searchResults[0].namaTempat);
    console.log("result", auth.user);
    console.log("result", auth.user.userId);
    const userId = auth.user.userId;
    const tempat = searchResults[0].namaTempat;
    const tempatId = searchResults[0].tempatId;

    const { post, processing } = useForm({});
    const submit = (e) => {
        e.preventDefault();
        console.log("Form Target:", e.target);
        const formData = {
            userId: auth.user.userId,
            tempatId: searchResults[0].tempatId,
            tanggal: e.target.tanggal.value,
            ticketType: e.target.ticketType.value,
        };
        console.log("form", formData);
        post(route("keepTickets"), formData);
    };

    return (
        <>
            <Nav />

            <section className="pt-24 pb-32 bg-slate-100">
                <div className="container mx-auto">
                    <div className="w-full px-4">
                        <div className="max-w-xl mx-auto text-center mb-8">
                            <h4 className="font-semibold text-lg text-primary mb-2">
                                Cari Tiket
                            </h4>
                            <h2 className="font-bold text-dark text-3xl mb-4 sm:text-4xl">
                                Cari Destinasi Yang Kamu Inginkan
                            </h2>
                        </div>
                    </div>
                    <div className="flex flex-wrap justify-center">
                        <div className="w-full max-w-md">
                            <div className="bg-white rounded-xl shadow-lg overflow-hidden pb-6">
                                <div className="flex flex-col w-full justify-center lg:flex-row">
                                    <form onSubmit={submit}>
                                        <div className="py-2">
                                            <input
                                                type="hidden"
                                                name="userId"
                                                value={userId}
                                            />
                                            <input
                                                type="hidden"
                                                name="tempatId"
                                                value={tempatId}
                                            />

                                            <label
                                                htmlFor="tempat"
                                                className="label"
                                            >
                                                Tempat yang kamu pilih
                                            </label>

                                            <input
                                                type="text"
                                                name="namaTempat"
                                                value={tempat}
                                                // placeholder={tempat}
                                            />
                                        </div>
                                        <div className="py-2">
                                            <label
                                                htmlFor="tanggal"
                                                className="label"
                                            >
                                                Tanggal
                                            </label>
                                            <select
                                                name="tanggal"
                                                id="tanggal"
                                                className="select select-bordered w-full"
                                            >
                                                {dateAndDays.map(
                                                    (selectDate, index) => (
                                                        <option
                                                            key={index}
                                                            value={
                                                                selectDate.date
                                                            }
                                                        >
                                                            {selectDate.day},
                                                            {selectDate.date}
                                                        </option>
                                                    )
                                                )}
                                            </select>
                                        </div>
                                        <div className="py-2">
                                            <label
                                                htmlFor="ticketType"
                                                className="label"
                                            >
                                                Tipe Tiket
                                            </label>
                                            <select
                                                name="ticketType"
                                                id="ticketType"
                                                className="select select-bordered w-full"
                                            >
                                                <option value="VIP">VIP</option>
                                                <option value="REGULER">
                                                    REGULER
                                                </option>
                                            </select>
                                        </div>
                                        <div className="py-4 px-6">
                                            <button
                                                className="btn btn-primary btn-block font-bold"
                                                disabled={processing}
                                            >
                                                Cari Tiket
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </>
    );
}

{
    /* {search
                            ? search.map((search, i) => {
                                  return (
                                      <div
                                          className="bg-white shadow-xl rounded-xl p-4 mx-auto"
                                          key={i}
                                      >
                                          <h1 className="text-2xl font-bold text-primary">
                                              {search.namaTempat}
                                          </h1>
                                          <div className="flex justify-between items-center mt-2">
                                              <div className="text-lg text-gray-800">
                                                  <p className="font-bold">
                                                      
                                                  </p>
                                              </div>
                                              <div className="text-sm mt-4 font-bold text-gray-800">
                                                  <p>Rp. {search.harga}</p>
                                              </div>
                                          </div>
                                      </div>
                                  );
                              })
                            : "<p>belum ada data</p>"} */
}
{
    /* <div className="container">
                        <div className="overflow-x-auto scrollbar-thin scrollbar-thumb-blue-500 scrollbar-track-blue-100">
                            <div className="flex justify-center ml-44 lg:ml-0 md:ml-0">
                                {dateAndDays ? (
                                    dateAndDays.map((date, d) => (
                                        <div key={d}>
                                            <JoinButton
                                                data={{
                                                    hari: date.hari,
                                                    tanggal: date.tanggal,
                                                }}
                                                onJoinClick={handleJoinClick}
                                                isActive={
                                                    activeButton &&
                                                    activeButton.tanggal ===
                                                        date.tanggal &&
                                                    activeButton.hari ===
                                                        date.hari
                                                }
                                                searchData={search}
                                            />
                                        </div>
                                    ))
                                ) : (
                                    <p>Belum ada data</p>
                                )}
                            </div>
                        </div>
                    </div> */
}

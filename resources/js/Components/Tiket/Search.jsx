import { useForm } from "@inertiajs/react";
import React, { useState } from "react";
export default function Search({ props }) {
    // console.log("Tiket", dateAndDays);
    // console.log("Tiket", today);
    // console.log("search", props);

    // const [activeButton, setActiveButton] = useState({ tanggal: "", hari: "" });

    const { data, setData, post, processing, errors, reset } = useForm({
        namaTempat: "",
    });

    console.log(data);
    const submit = (e) => {
        e.preventDefault();
        post(route("tickets"));
    };
    return (
        <section className="pt-24 pb-32 bg-slate-100">
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

            <div className="flex flex-wrap">
                <div className="w-full px-4">
                    <div className="bg-white rounded-xl shadow-lg overflow-hidden mb-10">
                        <div className="px-6">
                            <div>
                                <form onSubmit={submit}>
                                    <div className="py-2">
                                        <label
                                            htmlFor="namePlace"
                                            className="label"
                                        >
                                            Nama Tempat
                                        </label>
                                        <select
                                            className="select select-bordered w-full"
                                            id="namePlace"
                                            value={data.namaTempat}
                                            onChange={(e) =>
                                                setData(
                                                    "namaTempat",
                                                    e.target.value
                                                )
                                            }
                                        >
                                            <option value={""}>
                                                Pilih Tempat
                                            </option>
                                            {props.map((item, index) => (
                                                <option
                                                    key={index}
                                                    value={item.namaTempat}
                                                >
                                                    {item.namaTempat}
                                                </option>
                                            ))}
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
    );
}

const JoinButton = ({ data, onJoinClick, isActive }) => {
    return (
        <button
            className={`btn btn-md text-primary ${isActive ? "disabled" : ""}`}
            onClick={() => onJoinClick(data)}
            disabled={isActive}
        >
            {isActive
                ? `${data.hari} ${data.tanggal}`
                : `${data.hari} ${data.tanggal}`}
        </button>
    );
};

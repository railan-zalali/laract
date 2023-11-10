import Nav from "@/Components/Tiket/Nav";
import Search from "@/Components/Tiket/Search";

// export default function Tiket(props, search) {
export default function Tiket({ auth, props, dateAndDays, today }) {
    // console.log("Tiket", auth);
    console.log("Tiket", props);
    // console.log("Tiket", search);
    console.log("Tiket", dateAndDays);
    // console.log("Tiket", today);
    return (
        <>
            <Nav props={auth} />
            {/* <Search props={props} dateAndDays={dateAndDays} today={today} /> */}
            <Search props={props} />
        </>
    );
}

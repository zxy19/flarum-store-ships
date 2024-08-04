import PurchaseHistory from "@xypp-store/common/models/PurchaseHistory";
import StoreItem from "@xypp-store/common/models/StoreItem";
import app from "flarum/forum/app";
function _trans(key: string): string {
    return app.translator.trans(`xypp-store-ships.forum.${key}`) as string;
}
export function getShowCase(item: StoreItem, history?: PurchaseHistory) {
    if (!history) {
        return <div>
            <div><i></i></div>
            <div>{_trans("ship.to_send")}</div>
        </div>
    }
}
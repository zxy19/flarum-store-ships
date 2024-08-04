import app from 'flarum/forum/app';
import { addFrontendProviders } from "@xypp-store/forum"
import { getShowCase } from './showcase';

app.initializers.add('xypp/flarum-store-ships', () => {
  addFrontendProviders(
    "store-ships",
    app.translator.trans("xypp-store-ships.forum.name") as string,
    undefined,
    getShowCase
  )
});

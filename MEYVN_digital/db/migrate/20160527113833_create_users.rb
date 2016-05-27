class CreateUsers < ActiveRecord::Migration[5.0]
  def change
    create_table :users do |t|
      t.string :name

      t.timestamps
    end

    add_reference :comments, :user, index: true, foreign_key: true
  end
end
